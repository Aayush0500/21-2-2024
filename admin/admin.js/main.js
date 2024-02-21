 //main function
 function toggleMobileMenu() {
    var navigation = document.querySelector('.navigation');
    navigation.classList.toggle('active');
}

// admin.js/main.js

document.addEventListener('DOMContentLoaded', function () {
    // Attach click event handler to delete buttons
    var deleteButtons = document.querySelectorAll('.delete-button');
    
    deleteButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            // Get user ID from data-userid attribute
            var userID = this.getAttribute('data-userid');

            // Show confirmation dialog
            var confirmDelete = confirm('Are you sure you want to delete this user?');

            if (confirmDelete) {
                // Send AJAX request to delete-user.php
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'delete-user.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                
                // Send the user ID as POST data
                xhr.send('userID=' + userID);

                // Handle the response from the server
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        // Log the server response (you can do something more meaningful here)
                        console.log(xhr.responseText);

                        // Optionally, you can update the UI to reflect the deletion
                        // For example, remove the row from the table
                        if (xhr.responseText === 'User deleted successfully') {
                            var row = button.closest('tr');
                            row.parentNode.removeChild(row);
                        }
                    }
                };
            }
        });
    });
});
