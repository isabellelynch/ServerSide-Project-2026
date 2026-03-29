window.addEventListener("DOMContentLoaded", () => {
    
    let AddStudentForm = document.getElementById("StudentFormContainer");
    const Overlay = document.getElementById("overlay");
    let CloseFormButton = document.getElementById("CloseForm");
    let popup = document.getElementById("popup");
    let updateBtn = document.getElementById("UpdateStudentBtn");
    let addBtn = document.getElementById("AddStudentBtn");
    let removeBtn = document.getElementById("PermanentRemoval");
    let header = document.getElementById("FormHeader");
    let editButtons = document.querySelectorAll(".edit");
    let rows = document.querySelectorAll("#ViewAllTable tr");
    const nav = document.querySelector('nav');
    let headerBtn = document.getElementById("top-bar-btn");
    let overlay = document.getElementById('modalOverlay');

    headerBtn.addEventListener("click", openAddModal);
    overlay.addEventListener("click", closeAddModal);

    function openAddModal()
    {
        overlay.classList.add('active');
        updateScrollState();
    }

    function closeAddModal()
    {
        overlay.classList.remove('active');
        updateScrollState();
    }


    function updateScrollState() {
        if (overlay.classList.contains('active')) {
            document.body.style.overflow = "hidden";
        } else {
            document.body.style.overflow = "";
        }
    }

    // Edit buttons
    
    editButtons.forEach(b => {
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

    // Dropdown menu toggles
    document.querySelectorAll('.toggle').forEach(item => {
        item.addEventListener('click', function(e) {
            let parent = this.parentElement;
            let dropdown = parent.querySelector('.dropdown');

            if (dropdown) {
                e.preventDefault();
                document.querySelectorAll('.nav-item').forEach(i => {
                    i.classList.remove('active-parent');
                    let d = i.querySelector('.dropdown');
                    if (d) d.classList.remove('active-dropdown', 'open');
                });
                dropdown.classList.toggle('open');
                parent.classList.toggle('active-parent');
                if (dropdown.classList.contains('open')) {
                    dropdown.classList.add('active-dropdown');
                }
            }
        });
    });


    // Add Student link
    if (nav) {
        nav.addEventListener('click', function(e) {
            const link = e.target.closest('a');
            if (link.getAttribute('href') === 'AddStudent') {
                e.preventDefault();
                updateBtn.style.display = "none";
                removeBtn.style.display = "none";
                addBtn.style.display = "block";
                header.innerHTML = "New Student Form";
                openModal();
            }
        });
    }


});