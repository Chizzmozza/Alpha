const express = require("express");
const mysql = require("mysql");
const cors = require("cors");
const bodyParser = require("body-parser");

const app = express();
const PORT = 3001;

app.use(cors());
app.use(express.json());
app.use(bodyParser.json());

// MySQL Database Connection
const db = mysql.createConnection({
  host: "localhost",
  user: "bsituccc_alphagl",
  password: "alphagl2025",
  database: "bsituccc_alphagl"
});

db.connect((err) => {
  if (err) {
    console.error("Database connection failed: " + err.stack);
    return;
  }
  console.log("Connected to database");
});

// ================= RFID Routes ===================
// This is for card registration process
// let latestUID = null;

// // Receive UID from ESP32
// app.post('/senduid', (req, res) => {
//   const { uid } = req.body;
//   if (uid) {
//     console.log('Received UID for registration:', uid);
//     latestUID = uid;
//     res.send("OK");
//   } else {
//     res.status(400).send("No UID");
//   }
// });

// Frontend fetches latest UID
// app.get('/senduid/latest', (req, res) => {
//   res.json({ uid: latestUID });
// });

// // Clear UID (simulate CLEAR_LCD behavior)
// app.post('/senduid/clear', (req, res) => {
//   console.log("Received CLEAR_LCD");
//   latestUID = null;
//   res.send("OK");
// });

// ================= Attendance System Routes ===================
// This is for attendance logging (separate from registration)

// Fetch User Info
app.get("/fetchUser", (req, res) => {
  const uid = req.query.uid;
  if (!uid) {
    console.log("API Request Received: Missing UID");
    return res.status(400).json({ error: "UID is required" });
  }

  console.log(`API Request Received: UID = ${uid}`);

  const query = "SELECT Fname FROM user WHERE SerialCard = ?";
  db.query(query, [uid], (err, result) => {
    if (err) {
      console.error("Database Query Error: ", err);
      return res.status(500).json({ error: "Database error", details: err });
    }

    if (result.length > 0) {
      res.json({ name: result[0].Fname });
    } else {
      res.json({ name: "Unknown" });
    }
  });
});

// Log Attendance
app.post("/logAttendance", (req, res) => {
  const uid = req.body.uid;

  if (!uid) return res.status(400).json({ error: "UID is required" });

  const userQuery = "SELECT user_id, Fname, points FROM user WHERE SerialCard = ?";
  db.query(userQuery, [uid], (err, userResult) => {
    if (err || userResult.length === 0) {
      return res.json({ status: "Unknown", name: "Unknown" });
    }

    const user = userResult[0];
    const userId = user.user_id;
    const userName = user.Fname;
    const currentPoints = parseInt(user.points || "0");

    const attendanceQuery = "SELECT * FROM attendance WHERE user_id = ? ORDER BY attendance_id DESC LIMIT 1";
    db.query(attendanceQuery, [userId], (err, attendanceResult) => {
      if (err) return res.status(500).json({ error: "Attendance query error" });

      const now = new Date();
      const nowSql = now.toISOString().slice(0, 19).replace("T", " ");

      // TIME OUT
      if (attendanceResult.length > 0 && attendanceResult[0].time_out === null) {
        const updateAttendance = "UPDATE attendance SET time_out = ? WHERE attendance_id = ?";
        db.query(updateAttendance, [nowSql, attendanceResult[0].attendance_id], (err) => {
          if (err) return res.status(500).json({ error: "Failed to update attendance" });

          const pointsToAdd = 7; // Award 5 points on every Time Out
          const updatedPoints = currentPoints + pointsToAdd;
          const updatePoints = "UPDATE user SET points = ? WHERE user_id = ?";

          db.query(updatePoints, [updatedPoints.toString(), userId], (err) => {
            if (err) return res.status(500).json({ error: "Failed to update points" });

            return res.json({ status: "Time Out", name: userName });
          });
        });
        return;
      }

      // TIME IN
      const insertTimeIn = "INSERT INTO attendance (user_id, name, time_in) VALUES (?, ?, ?)";
      db.query(insertTimeIn, [userId, userName, nowSql], (err) => {
        if (err) return res.status(500).json({ error: "Insert time-in failed" });

        return res.json({ status: "Time In", name: userName });
      });
    });
  });
});

// ================= ESP32 RFID Proxy ===================
// This allows the ESP32 to send to a working endpoint but forward to the correct handler

// Create a proxy for ESP32 that might be having path issues
// app.post("/", (req, res) => {
//   const { uid } = req.body;
  
//   if (!uid) {
//     return res.status(400).send("No UID provided");
//   }
  
//   console.log(`Received UID at root path: ${uid}`);
  
//   // Determine which functionality is needed based on path parameter or query
//   const isForAttendance = req.query.type === "attendance";
  
//   if (isForAttendance) {
//     // If it's for attendance logging, handle attendance logic
//     console.log("Forwarding to attendance system");
//     // Call attendance logic with the UID
//     const userQuery = "SELECT user_id, Fname, points FROM user WHERE SerialCard = ?";
//     db.query(userQuery, [uid], (err, userResult) => {
//       // Same logic as in logAttendance endpoint
//       // (Code redacted for brevity - would be the same as the logAttendance handler)
//       if (err || userResult.length === 0) {
//         return res.json({ status: "Unknown", name: "Unknown" });
//       }
      
//       // Process attendance (simplified response)
//       return res.json({ status: "Processed", name: userResult[0].Fname });
//     });
//   } else {
//     // If it's for card registration, update the latestUID
//     console.log("Setting UID for registration system");
//     latestUID = uid;
//     res.send("OK");
//   }
// });

// Start Server
app.listen(PORT, () => {
  console.log(`Server running on http://localhost:${PORT}`);
});