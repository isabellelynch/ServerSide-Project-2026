window.addEventListener("DOMContentLoaded", () => {
    /************************   FORM CONTROLS   ***********************************/

    let form = document.getElementById("common-form");
    let headerBtn = document.getElementById("top-bar-btn");
    let overlay = document.getElementById("modalOverlay");
    let cancel = document.getElementById("cancel-form-btn");
    let exitForm = document.getElementById("modal-x");

    headerBtn.addEventListener("click", openForm);
    overlay.addEventListener("click", handleOverlay);
    cancel.addEventListener("click", closeForm);

    if(exitForm){
        exitForm.addEventListener("click", closeForm);
    }
    

    function openForm()
    {
        overlay.classList.add('active');
        updateScrollState();
    }

    function closeForm()
    {
        overlay.classList.remove('active');
        updateScrollState();
        form.reset();
    }

    function handleOverlay(e)
    {
        if (e.target === overlay) closeForm();
    }

    function updateScrollState() {
        if (overlay.classList.contains('active')) {
            document.body.style.overflow = "hidden";
        } else {
            document.body.style.overflow = "";
        }
    }

    let classes = document.querySelectorAll(".class-slot");
    
    
    if(classes){
        classes.forEach(el => {
            el.addEventListener("click", () => {
                document.getElementById("modalTitle").innerHTML = "Make Booking";
                document.getElementById("modalSub").innerHTML = "Add student to class list";

                fetch("Forms/FormBodies/AddStudentFromCalendar.html")
                    .then(res => res.text())
                    .then(html => {
                        document.getElementById("common-form").innerHTML = html;
                });
                
                setTimeout(() => {
                    openForm();
                    let classid = document.getElementById("ClassID");
                    if(classid){
                        classid.dataset.id = el.dataset.id;
                    }
                }, 100); 
            }
        )});

    }
    

    /************************   END FORM CONTROLS   ***********************************/

    /*editButtons.forEach(b => {
        b.addEventListener("click", (e) => {
            e.preventDefault();
            updateBtn.style.display = "block";
            removeBtn.style.display = "block";
            addBtn.style.display = "none";
            header.innerHTML = "Update Student Form";
            document.querySelector('[name="id"]').value = b.dataset.id;
            document.querySelector('[name="FirstName"]').value = b.dataset.firstname;
            document.querySelector('[name="Surname"]').value = b.dataset.surname;
            document.querySelector('[name="Email"]').value = b.dataset.email;
            document.querySelector('[name="PhoneNo"]').value = b.dataset.phone;
            openModal();
        });
    });


    // Table row selection
    rows.forEach(row => row.addEventListener("click", () => {
        rows.forEach(r => r.classList.remove("selected"));
        row.classList.add("selected");
    }));

*/

});