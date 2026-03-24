window.addEventListener("DOMContentLoaded", () => {

    let AddStudentForm = document.getElementById("StudentFormContainer");
    let Overlay = document.getElementById("overlay");
    let Removal = document.getElementById("PermanentRemoval");
    let operationButton = document.getElementById('StudentOperationButton');
    let CloseFormButton = document.getElementById("closeForm");
    let FormHeader = document.getElementById("FormHeader");

    function openModal() {
        if (Overlay) Overlay.style.display = "block";
        if (AddStudentForm) AddStudentForm.style.display = "block";
        updateScrollState();
    }

    function closeModal() {
        if (Overlay) Overlay.style.display = "none";
        if (AddStudentForm) AddStudentForm.style.display = "none";
        updateScrollState();
        

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
    let rows = document.querySelectorAll("#ViewAllTable tr");
    rows.forEach(row => row.addEventListener("click", () => {
        rows.forEach(r => r.classList.remove("selected"));
        row.classList.add("selected");
    }));

    // Dropdown menu toggles
    document.querySelectorAll('.toggle').forEach(item => {
        item.addEventListener('click', function(e) {
            let parent = this.parentElement;
            let dropdown = parent.querySelector('.dropdown');

            if (dropdown) {
                e.preventDefault();

                // close others + remove highlights
                document.querySelectorAll('.nav-item').forEach(i => {
                    i.classList.remove('active-parent');
                    let d = i.querySelector('.dropdown');
                    if (d) d.classList.remove('active-dropdown', 'open');
                });

                // toggle current
                dropdown.classList.toggle('open');
                parent.classList.toggle('active-parent');

                if (dropdown.classList.contains('open')) {
                    dropdown.classList.add('active-dropdown');
                }
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