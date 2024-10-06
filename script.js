// Dropdown toggle
function toggleDropdown() {
    const dropdown = document.getElementById('profileDropdown');
    dropdown.classList.toggle('active');
}
// Load profile photo from cookie
function getCookie(name) {
    let cookieArr = document.cookie.split(";");
    for (let i = 0; i < cookieArr.length; i++) {
        let cookiePair = cookieArr[i].split("=");
        if (name == cookiePair[0].trim()) {
            return decodeURIComponent(cookiePair[1]);
        }
    }
    return null;
}

// Update the profile picture based on the cookie
function updateProfilePicture() {
    const profilePic = document.getElementById('profilePic');
    const storedPhoto = getCookie('profilePhoto');
    if (storedPhoto) {
        profilePic.src = storedPhoto; // Set the profile picture
    } else {
        profilePic.src = 'default-profile.png'; // Set a default image if no cookie found
    }
}

// Call this function on page load
window.onload = updateProfilePicture;


// Open side menu
function openMenu() {
    document.getElementById("sideMenu").style.left = "0";
}

// Close side menu
function closeMenu() {
    document.getElementById("sideMenu").style.left = "-250px";
}