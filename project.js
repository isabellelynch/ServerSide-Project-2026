window.addEventListener("DOMContentLoaded", () => {

    // Get modal elements if they exist
    let AddStudentForm = document.getElementById("StudentFormContainer");
    let Overlay = document.getElementById("overlay");
    let Removal = document.getElementById("PermanentRemoval");
    let operationButton = document.getElementById('StudentOperationButton');
    let CloseFormButton = document.getElementById("closeForm");
    let FormHeader = document.getElementById("FormHeader");

    // Utility functions (safe)
    function openModal() {
        if (Overlay) Overlay.style.display = "block";
        if (AddStudentForm) AddStudentForm.style.display = "block";
        updateScrollState()
    }

    function closeModal() {
        if (Overlay) Overlay.style.display = "none";
        if (AddStudentForm) AddStudentForm.style.display = "none";
        updateScrollState()
    }


    if (Overlay) Overlay.addEventListener("click", closeModal);

    
    function isVisible(x) {
        if(x.style.display === 'none'){
            return false;
        }
        else{
            return true;
        }
    }

    function updateScrollState() {
        if (isVisible(AddStudentForm)) {
            document.body.style.overflow = "hidden";
        } else {
            document.body.style.overflow = "";
        }
    }
    // Close modal button
    if (CloseFormButton) {
        CloseFormButton.addEventListener("click", closeModal);
    }

    // Edit buttons
    let editButtons = document.querySelectorAll(".edit");

    editButtons.forEach(button => {
        button.addEventListener("click", () => {
            let mode = button.dataset.mode;

            openModal();

            if(FormHeader){
                FormHeader.innerHTML = mode === 'edit' ? "Update Student Form" : "New Student Form";
            }

            if (operationButton) {
                operationButton.innerHTML = mode === 'edit' ? "Update Student" : "Add Student";
            }

            if (Removal) {
                Removal.style.display = mode === 'edit' ? "block" : "none";
            }

            if(mode === 'edit') {
                document.querySelector("input[name='FirstName']").value = button.dataset.firstname;
                document.querySelector("input[name='Surname']").value = button.dataset.surname;
                document.querySelector("input[name='Email']").value = button.dataset.email;
                document.querySelector("input[name='PhoneNo']").value = button.dataset.phone;
                document.querySelector("input[name='id']").value = button.dataset.id;
            }
        });
    });

    // Table row selection
    let rows = document.querySelectorAll("#table tr");
    rows.forEach(row => row.addEventListener("click", () => {
        rows.forEach(r => r.classList.remove("selected"));
        row.classList.add("selected");
    }));

    // Dropdown menu toggles
    document.querySelectorAll('.toggle').forEach(item => {
        item.addEventListener('click', function(e) {
            const parent = this.parentElement;
            const dropdown = parent.querySelector('.dropdown');

            if (dropdown && this.classList.contains('active')) {
                e.preventDefault();

                document.querySelectorAll('.dropdown').forEach(d => {
                    if (d !== dropdown) d.classList.remove('open');
                });

                dropdown.classList.toggle('open');
            }
        });
    });



    // Add Student link
    const nav = document.querySelector('nav');
    if (nav) {
        nav.addEventListener('click', function(e) {
            const link = e.target.closest('a');
            if (!link) return;

            if (link.getAttribute('href') === 'AddStudent.php') {
                e.preventDefault();

                openModal();

                if(FormHeader){
                    FormHeader.innerHTML = "New Student Form";
                }

                if (operationButton) {
                    operationButton.innerHTML = "Add Student";
                }
            }

            


        });
    }

});