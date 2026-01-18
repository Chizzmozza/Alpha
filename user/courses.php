<?php include ("navbar.php"); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
    <title>courses</title>
  </head>
  <body>

    <section id="main-content" class="d-flex flex-column justify-content-center align-items-center text-center">
        <div class="container">
            <h2 class="display-3 fw-bold text-white">Alpha Grind Lab</h2>
            <p class="fw-bold  text-white">MAKE THAT FIRST STEP, YOU WILL NEVER WANT TO STOP.</p>
        </div>
    </section>

    <section id="courses" class="py-5">
    <div class="container">
        <h3 class="fw-bold text-center">COURSES OFFER</h3>
        <div class="row justify-content-center mt-4">

            <div class="col-md-10">
                <div class="d-flex border bg-white rounded p-4">
                    <div class="col-md-4">
                        <img src="../pictures/gymm.png" alt="Muay Thai" class="img-fluid rounded"
                        style="height: 200px; width: 100%; object-fit: cover;">
                    </div>
                    <div class="col-md-8 ps-4">
                        <h2>Muay Thai</h2>
                        <p class="text-muted">
                            Muay Thai, also known as the "Art of Eight Limbs," is a combat sport and martial art from Thailand that utilizes punches,
                            kicks, elbows, and knee strikes. It is known for its powerful striking techniques, clinch fighting, and emphasis on conditioning and endurance.
                        </p>
                    </div>
                </div>
            </div>


            <div class="col-md-10 mt-4">
                <div class="d-flex border bg-white rounded p-4">
                    <div class="col-md-4">
                        <img src="../pictures/gymm.png" alt="Taekwondo" class="img-fluid rounded"
                        style="height: 200px; width: 100%; object-fit: cover;">
                    </div>
                    <div class="col-md-8 ps-4">
                        <h2>Taekwondo</h2>
                        <p class="text-muted">
                            Taekwondo is a Korean martial art that emphasizes high, fast kicks, dynamic footwork, and disciplined self-defense techniques.
                            It combines physical fitness, mental discipline, and traditional values, making it both a sport and a way of life.
                        </p>
                    </div>
                </div>
            </div>


            <div class="col-md-10 mt-4">
                <div class="d-flex border bg-white rounded p-4">
                    <div class="col-md-4">
                        <img src="../pictures/gymm.png" alt="Boxing" class="img-fluid rounded"
                        style="height: 200px; width: 100%; object-fit: cover;">
                    </div>
                    <div class="col-md-8 ps-4">
                        <h2>Boxing</h2>
                        <p class="text-muted">
                            Boxing is a combat sport where two opponents, wearing gloves, use only their fists to strike each other while following strict rules.
                            It emphasizes footwork, head movement, and strategic punching to outscore or knock out the opponent.
                        </p>
                    </div>
                </div>
            </div>


            <div class="col-md-10 mt-4">
                <div class="d-flex border bg-white rounded p-4">
                    <div class="col-md-4">
                        <img src="../pictures/gymm.png" alt="Karate" class="img-fluid rounded"
                        style="height: 200px; width: 100%; object-fit: cover;">
                    </div>
                    <div class="col-md-8 ps-4">
                        <h2>Karate</h2>
                        <p class="text-muted">
                            Karate is a Japanese martial art that focuses on striking techniques using punches, kicks, knee strikes,
                            and open-hand techniques for self-defense and discipline. It emphasizes speed, precision,
                            and kata (forms) to develop both physical and mental strength.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <script>
    document.addEventListener("DOMContentLoaded", function () {
        let bookedDates = ["2025-02-25", "2025-02-28", "2025-03-05"]; // Example booked dates

        let calendarEl = document.getElementById('calendar');
        let selectedDateDisplay = document.getElementById("selectedDateDisplay");
        let selectedDateInput = document.getElementById("selectedDateInput");
        let confirmDateButton = document.getElementById("confirmDate");
        let selectedDate = "";

        function formatDate(dateStr) {
            let date = new Date(dateStr);
            let options = { year: 'numeric', month: 'short', day: 'numeric' };
            return date.toLocaleDateString('en-US', options);
        }

        let calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            selectable: true,
            dateClick: function(info) {
                if (!bookedDates.includes(info.dateStr)) {
                    selectedDate = info.dateStr;
                    selectedDateInput.value = info.dateStr;
                    selectedDateDisplay.textContent = "Selected Date: " + formatDate(info.dateStr);
                } else {
                    selectedDateDisplay.textContent = "This date is already booked.";
                }
            },
            events: bookedDates.map(date => ({
                title: 'Booked',
                start: date,
                allDay: true,
                color: '#ffcccc'
            }))
        });

        document.getElementById("calendarModal").addEventListener("shown.bs.modal", function () {
            calendar.render();
        });

        confirmDateButton.addEventListener("click", function () {
            if (selectedDate) {
                document.getElementById("clientLink").href = "/schedule?date=" + selectedDate;
                alert("Date confirmed: " + formatDate(selectedDate));
            } else {
                alert("Please select a date first.");
            }
        });
    });
</script>


</section>
<?php include ("footer.php"); ?>
  </body>
</html>
