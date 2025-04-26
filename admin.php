<?php
session_start();
include '../login system with avatar/config.php';

// Check if user is logged in and is admin
if(!isset($_SESSION['admin_name'])){
   header('location:../login system with avatar/login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            min-height: 100vh;
        }

        .admin-container {
            display: flex;
            width: 100%;
        }

        .sidebar {
            background-color: #2c3e50;
            color: white;
            width: 250px;
            padding: 20px;
            height: 100vh;
        }

        .sidebar h2 {
            color: #ecf0f1;
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 20px 0;
        }

        .sidebar ul li a {
            color: #ecf0f1;
            text-decoration: none;
            font-size: 18px;
            display: block;
        }

        .sidebar ul li a:hover {
            background-color: #34495e;
            padding: 10px;
            border-radius: 5px;
        }

        .main-content {
            flex: 1;
            padding: 20px;
        }

        h1, h2 {
            color: #34495e;
        }

        .content-section {
            display: none;
        }

        #add-photo-form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        #add-photo-form input,
        #add-photo-form select {
            padding: 8px;
            font-size: 16px;
        }

        button {
            padding: 10px 15px;
            background-color: #2980b9;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #3498db;
        }

        /* Gallery Section Styling */
        #gallery {
            padding: 20px 0;
        }

        #gallery h2 {
            margin-bottom: 20px;
        }

        .gallery-filter {
            margin-bottom: 20px;
        }

        .gallery-filter label {
            font-size: 16px;
            color: #34495e;
            margin-right: 10px;
        }

        .gallery-filter select {
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 200px;
        }

        .gallery-actions {
            margin-bottom: 20px;
        }

        .gallery-actions button {
            background-color: #e74c3c;
            margin-left: 10px;
        }

        .gallery-actions button:hover {
            background-color: #c0392b;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }

        .gallery-item {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            text-align: center;
        }

        .gallery-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .gallery-item p {
            margin: 5px 0;
            font-size: 14px;
            color: #34495e;
        }

        .gallery-item button {
            margin-top: 10px;
            padding: 5px 10px;
            background-color: #e74c3c;
        }

        .gallery-item button:hover {
            background-color: #c0392b;
        }

        .no-photos {
            color: #7f8c8d;
            font-style: italic;
        }

        .upload-status {
            margin-top: 10px;
            font-size: 14px;
        }

        .upload-status.success {
            color: green;
        }

        .upload-status.error {
            color: red;
        }

        /* User Management Styling */
        .user-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.2);
            border-radius: 8px;
            overflow: hidden;
        }

        .user-table th, .user-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .user-table th {
            background-color: #2c3e50;
            color: white;
        }

        .user-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .user-table tr:hover {
            background-color: #ddd;
        }

        .delete-btn {
            background-color: #e74c3c;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .delete-btn:hover {
            background-color: #c0392b;
        }

        /* Success/Error Messages */
        .message {
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
        }

        .success {
            background-color: #2ecc71;
            color: white;
        }

        .error {
            background-color: #e74c3c;
            color: white;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="sidebar">
            <h2>Admin Panel</h2>
            <ul>
                <li><a href="#" id="dashboard-link">Dashboard</a></li>
                <li><a href="#" id="users-link">Manage Users</a></li>
                <li><a href="#" id="gallery-link">Gallery</a></li>
                <li><a href="#" id="add-photo-link">Add Photo</a></li>
                <li><a href="#" id="logout-link">Logout</a></li>
            </ul>
        </div>
        <div class="main-content">
            <h1>Welcome to the Photography Admin Panel</h1>
            
            <div id="dashboard" class="content-section">
                <h2>Dashboard Overview</h2>
                <p>Here you can view website analytics and recent activities.</p>
            </div>

            <div id="users" class="content-section" style="display:none;">
                <h2>User Management</h2>
                <div class="user-list">
                    <?php
                    $select = mysqli_query($conn, "SELECT * FROM `user_form`") or die('query failed');
                    if(mysqli_num_rows($select) > 0) {
                        echo '<table class="user-table">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>';
                        while($row = mysqli_fetch_assoc($select)) {
                            echo '<tr>
                                    <td>'.$row['id'].'</td>
                                    <td>'.$row['name'].'</td>
                                    <td>'.$row['email'].'</td>
                                    <td>
                                        <button class="delete-btn" onclick="deleteUser('.$row['id'].')">Delete User</button>
                                    </td>
                                </tr>';
                        }
                        echo '</table>';
                    } else {
                        echo '<p>No users found!</p>';
                    }
                    ?>
                </div>
            </div>

            <div id="gallery" class="content-section" style="display:none;">
                <h2>Gallery</h2>
                <div class="gallery-filter">
                    <label for="event-filter">Filter by Event ID:</label>
                    <select id="event-filter" onchange="filterPhotos()">
                        <option value="">All Events</option>
                        <!-- Event options will be populated dynamically -->
                    </select>
                </div>
                <div class="gallery-actions">
                    <button onclick="deletePhotosByEvent()">Delete Selected Event Photos</button>
                </div>
                <div id="gallery-grid" class="gallery-grid">
                    <!-- Photos will be populated dynamically -->
                </div>
            </div>

            <div id="add-photo" class="content-section" style="display:none;">
                <h2>Add New Photo</h2>
                <form id="add-photo-form" enctype="multipart/form-data" method="POST" action="upload_photos.php">
                    <label for="event-id">Event ID:</label>
                    <input type="number" id="event-id" name="event_id" required>

                    <label for="photo-files">Select Photos (Multiple):</label>
                    <input type="file" id="photo-files" name="photo_files[]" accept="image/*" multiple required>

                    <button type="submit">Upload Photos</button>
                </form>
                <p id="upload-status" class="upload-status">
                    <?php
                    // Display upload status if redirected back with a message
                    if (isset($_GET['upload_status'])) {
                        $status = $_GET['upload_status'];
                        $message = urldecode($_GET['message']);
                        echo "<span class='$status'>$message</span>";
                    }
                    ?>
                </p>
            </div>
        </div>
    </div>
    
    <script>
        // Show dashboard by default
        document.getElementById('dashboard').style.display = 'block';

        document.getElementById('dashboard-link').addEventListener('click', function() {
            showSection('dashboard');
        });

        document.getElementById('users-link').addEventListener('click', function() {
            showSection('users');
        });

        document.getElementById('gallery-link').addEventListener('click', function() {
            showSection('gallery');
            loadGallery();
        });

        document.getElementById('add-photo-link').addEventListener('click', function() {
            showSection('add-photo');
        });

        document.getElementById('logout-link').addEventListener('click', function() {
            alert('Logged out!');
            // Implement your logout functionality here
        });

        function showSection(sectionId) {
            // Hide all sections
            document.querySelectorAll('.content-section').forEach(section => {
                section.style.display = 'none';
            });
            
            // Show the selected section
            document.getElementById(sectionId).style.display = 'block';
        }

        function deleteUser(userId) {
            if(confirm('Are you sure you want to delete this user?')) {
                fetch('delete_user.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'user_id=' + userId
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        alert('User deleted successfully!');
                        location.reload();
                    } else {
                        alert('Error deleting user: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while deleting the user');
                });
            }
        }

        // Gallery Section JavaScript
        let photos = [];

        function loadGallery() {
            fetch('fetch_photos.php')
                .then(response => response.json())
                .then(data => {
                    photos = data;
                    const eventFilter = document.getElementById('event-filter');
                    const eventIds = [...new Set(photos.map(photo => photo.E_ID))];
                    eventFilter.innerHTML = '<option value="">All Events</option>';
                    eventIds.forEach(eventId => {
                        const option = document.createElement('option');
                        option.value = eventId;
                        option.textContent = `Event ${eventId}`;
                        eventFilter.appendChild(option);
                    });
                    displayPhotos(photos);
                })
                .catch(error => console.error('Error fetching photos:', error));
        }

        function filterPhotos() {
            const eventFilter = document.getElementById('event-filter').value;
            let filteredPhotos = photos;

            if (eventFilter) {
                filteredPhotos = photos.filter(photo => photo.E_ID == eventFilter);
            }

            displayPhotos(filteredPhotos);
        }

        function displayPhotos(photosToDisplay) {
            const galleryGrid = document.getElementById('gallery-grid');
            galleryGrid.innerHTML = '';

            if (photosToDisplay.length === 0) {
                galleryGrid.innerHTML = '<p class="no-photos">No photos found for this event.</p>';
                return;
            }

            photosToDisplay.forEach(photo => {
                const galleryItem = document.createElement('div');
                galleryItem.classList.add('gallery-item');
                galleryItem.innerHTML = `
                    <img src="gallery/${photo.img_url}" alt="Photo ${photo.photo_id}">
                    <p>Photo ID: ${photo.photo_id}</p>
                    <p>Event ID: ${photo.E_ID}</p>
                    <button onclick="deletePhoto(${photo.photo_id})">Delete</button>
                `;
                galleryGrid.appendChild(galleryItem);
            });
        }

        function deletePhoto(photoId) {
            if (confirm('Are you sure you want to delete this photo?')) {
                fetch('delete_photo.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ photo_id: photoId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        photos = photos.filter(photo => photo.photo_id !== photoId);
                        filterPhotos();
                        alert('Photo deleted successfully!');
                    } else {
                        alert('Error deleting photo: ' + data.message);
                    }
                })
                .catch(error => console.error('Error deleting photo:', error));
            }
        }

        function deletePhotosByEvent() {
            const eventId = document.getElementById('event-filter').value;
            if (!eventId) {
                alert('Please select an event to delete photos.');
                return;
            }

            if (confirm(`Are you sure you want to delete all photos for Event ${eventId}?`)) {
                fetch('delete_photos_by_event.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ event_id: eventId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        photos = photos.filter(photo => photo.E_ID != eventId);
                        filterPhotos();
                        loadGallery(); // Refresh the event filter
                        alert('Photos deleted successfully!');
                    } else {
                        alert('Error deleting photos: ' + data.message);
                    }
                })
                .catch(error => console.error('Error deleting photos:', error));
            }
        }
    </script>
</body>
</html>
