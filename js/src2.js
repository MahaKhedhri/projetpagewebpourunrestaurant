
function validateForm() {
    const form = document.forms["reservationForm"];
    const name = form["name"].value.trim(); 
    const phone = form["phone"].value.trim();
    const people = form["people"].value;
    const date = form["date"].value;
    const time = form["time"].value;
    if (!name || !phone || !people || !date || !time) {
        alert("Please fill in all required fields.");
        return false;
    }
    const nameCS = /^[A-Za-z\s]{2,}$/; 
    const phoneCS = /^\d{8}$/;  
    if (!nameCS.test(name)) {
        alert("Name must contain only letters and be at least 2 characters.");
        return false;
    }
    if (!phoneCS.test(phone)) {
        alert("Phone number must be exactly 8 digits.");
        return false;
    }
    return true;
}