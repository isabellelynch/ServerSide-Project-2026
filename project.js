window.addEventListener("DOMContentLoaded", () => {
    /************************   FORM CONTROLS   ***********************************/

    let form = document.getElementById("common-form");
    let headerBtn = document.getElementById("top-bar-btn");
    let overlay = document.getElementById("modalOverlay");
    let cancel = document.getElementById("cancel-form-btn");
    let exitForm = document.getElementById("modal-x");
    let classes = document.querySelectorAll(".class-slot");
    let bookclassFormBody = document.getElementById("book-for-student");
    let newClassFormBody = document.getElementById("add-new-class");
    let error = document.getElementById("toast");
    let errorMsg = document.getElementById("error");
    let successMsg = document.getElementById("success");
    let filter = document.getElementById("table-filter");
    let table = document.getElementById("ViewAllTable");


    headerBtn.addEventListener("click", () => {
        openForm();
        toggleNewClassForm();
    });
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

    
    
    
    if(classes){
        classes.forEach(el => {
            el.addEventListener("click", () => {
                setTimeout(() => {
                    openForm();
                    toggleNewStudentForm();
                    let classid = document.getElementById("ClassID");
                    if(classid){
                        classid.value = el.dataset.id;
                    }
                }, 100); 
            }
        )});

    }

    function toggleNewClassForm(){
        bookclassFormBody.style.display = 'none';
        newClassFormBody.style.display = 'block';
    }
    function toggleNewStudentForm(){
        document.getElementById("modalTitle").innerHTML = "Make Booking";
        document.getElementById("modalSub").innerHTML = "Add student to class list";
        bookclassFormBody.style.display = 'block';
        newClassFormBody.style.display = 'none';
    }

    let msgTitle = document.getElementById("toastTitle");
    if(error){
        msgTitle.innerText = "";

        if(errorMsg && errorMsg.innerText != ""){
                msgTitle.innerText = "Error";
        }
        if(successMsg && successMsg.innerText != ""){
            msgTitle.innerText = "Success";
        }
        if(msgTitle.innerText != ""){
            error.classList.add("show");
            setTimeout(() => {
                error.classList.remove("show");
            }, 3000);
        }
    }
    
    function filterTable(tableId, q){
        let rows = document.querySelectorAll('#' + tableId + ' tbody tr');
        rows.forEach(r => { 
            r.style.display = r.textContent.toLowerCase().includes(q.toLowerCase())?'':'none';
        });
    }
    filter.addEventListener("input", (e) => {
        filterTable("ViewAllTable", e.target.value)
    });



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