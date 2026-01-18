const express = require("express");
const axios = require("axios");
const cors = require("cors");

const app = express();
app.use(cors());
app.use(express.json());

const PHP_SERVER_URL = "http://localhost/hardwareconnection.php"; // Change if hosted remotely

app.get("/fetchUser", async (req, res) => {
    const { SerialCard } = req.query;

    if (!SerialCard) {
        return res.status(400).json({ error: "Missing SerialCard parameter" });
    }

    try {
        const response = await axios.get(PHP_SERVER_URL, { params: { SerialCard } });
        res.json(response.data);
    } catch (error) {
        console.error("Error fetching data:", error);
        res.status(500).json({ error: "Internal Server Error" });
    }
});

const PORT = 3000;
app.listen(PORT, () => {
    console.log(`Node.js server running on port ${PORT}`);
});
