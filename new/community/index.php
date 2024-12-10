<?php

include("../defination.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Page</title>
    <?php echo $quiz_font ?>
    <link rel="stylesheet" href="styles.css">
    <script defer src="script.js"></script>
</head>
<body>
    <header>
        <h1>Community Page</h1>
        <nav>
            <ul>
                <li><a href="#members">Members</a></li>
                <li><a href="#events">Events</a></li>
                <li><a href="#groups">Groups</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section id="members">
            <h2>Community Members</h2>
            <div class="member-list">
                <!-- Member details will be dynamically added here -->
            </div>
        </section>
        <section id="events">
            <h2>Community Events</h2>
            <div class="event-list">
                <!-- Event details will be dynamically added here -->
            </div>
        </section>
        <section id="groups">
            <h2>Community Groups</h2>
            <div class="group-list">
                <!-- Group details will be dynamically added here -->
            </div>
        </section>
    </main>
</body>
</html>
