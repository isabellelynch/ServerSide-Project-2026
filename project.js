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
    }

    function closeModal() {
        if (Overlay) Overlay.style.display = "none";
        if (AddStudentForm) AddStudentForm.style.display = "none";
    }

    function getOperationButtonText() {
        return operationButton ? operationButton.innerText : "";
    }

    // Page-specific logic for removal button
    if (Removal) {
        Removal.style.display = getOperationButtonText() === "Update Student" ? "block" : "none";
    }

    // Close modal button
    if (CloseFormButton) {
        CloseFormButton.addEventListener("click", closeModal);
    }

    // Edit buttons
    const editButtons = document.querySelectorAll(".edit");
    editButtons.forEach(button => {
        button.addEventListener("click", () => {
            const id = button.dataset.id;
            openModal();
            if (Removal) Removal.style.display = "block";
            if (operationButton) {
                    operationButton.innerHTML = "Update Student";
                }
            if(FormHeader){
                    FormHeader.innerHTML = "Update Student Form";
                }
        });
    });

    // Table row selection
    const rows = document.querySelectorAll("#table tr");
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