<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="css/book.css">
    <title>Zax|Book A Consultation</title>
</head>
<body>
    <form>
        <h1>Book A Consultation</h1>
        <input type="text" placeholder="Name" id="name" name="name" required>
        <label for ="name">Name</label>
        <input type="email" id="email" placeholder="Email" name="email" required>
        <label for="email">Email</label>
        <input type="tel" id="phone" placeholder="Phone" name="phone" required>
        <label for="phone">Phone</label>
        <input type="date" id="date" placeholder="Date" required>

        <input type="time" id="time" name="time" required>

        <select id="service" name="service" required>
            <option value="" disabled selected>Select Service</option>
            <option value="Development">Development</option>
            <option value="Gaming">Gaming</option>
            <option value="Workstations">Workstations</option>
        </select>

        <button id="submit" type="submit">Submit</button>
</body>
</html>