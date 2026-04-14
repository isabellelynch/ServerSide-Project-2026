window.addEventListener("DOMContentLoaded", () => {
    let page = document.body.dataset.page;

    let formTitle = document.getElementById("modalTitle");
    let formSubTitle = document.getElementById("modalSub");
    let formSaveBtn = document.getElementById("save-btn");
    let headerBtn = document.getElementById("top-bar-btn");
    let pageHeading = document.getElementById("topbarTitle");

    let bookclassFormBody = document.getElementById("book-for-student");
    let newClassFormBody = document.getElementById("add-new-class");
    let removeFormBody = document.getElementById("remove");
    let newOrUpdateForm = document.getElementById("new-or-update-form");
    let newAdminForm = document.getElementById("new-admin-form");

    let activeForm = document.getElementById("activeForm");

    function toggleNewClassForm(){
        formTitle.innerHTML = "Add Class";
        formSubTitle.innerHTML = "Add a new class to the system";
        bookclassFormBody.style.display = 'none';
        newClassFormBody.style.display = 'block';
        activeForm.value = "new-class";
    }

    function toggleNewAdminForm(){
        formTitle.innerHTML = "New Staff Member";
        formSubTitle.innerHTML = "Add a new staff member to the system";
        newAdminForm.style.display = 'block';
        bookclassFormBody.style.display = 'none';
        activeForm.value = "new-admin";
    }
    function toggleAddStudentToClassForm(){
        formTitle.innerHTML = "Make Booking";
        formSubTitle.innerHTML = "Add student to class list";
        if(newAdminForm){
            newAdminForm.style.display = 'none';
        }
        else if (newClassFormBody){
            newClassFormBody.style.display = "none";
        }
        
        bookclassFormBody.style.display = 'block';
        activeForm.value = "add";
    }

    function toggleUpdateForm(){
        if(page === "tutors"){
            formTitle.innerHTML = "Update Tutor";
            formSubTitle.innerHTML = "Make the necessary changes to tutors details";
        }
        if(page === "students"){
            formTitle.innerHTML = "Update Student";
            formSubTitle.innerHTML = "Make the necessary changes to students details";
        }
        formSaveBtn.innerHTML = "Update";
        newOrUpdateForm.style.display = 'block';
        removeFormBody.style.display = 'none';
        activeForm.value = "update";
    }
    function toggleNewForm(){
        if(page === "tutors"){
            formTitle.innerHTML = "New Tutor";
            formSubTitle.innerHTML = "Add a new Tutor to the system";
        }
        if(page === "students"){
            formTitle.innerHTML = "New Student";
            formSubTitle.innerHTML = "Add a new Student to the system";
        }
        formSaveBtn.innerHTML = "Save";
        newOrUpdateForm.style.display = 'block';
        removeFormBody.style.display = 'none';
        activeForm.value = "new";
    }

    function toggleDeleteForm(){
        if(page === "tutors"){
            formTitle.innerHTML = "Remove Tutor";
            formSubTitle.innerHTML = "Please confirm tutor removal";
        }
        if(page === "students"){
            formTitle.innerHTML = "Remove Student";
            formSubTitle.innerHTML = "Please confirm student removal";
        }
        formSaveBtn.innerHTML = "Remove";
        newOrUpdateForm.style.display = 'none';
        removeFormBody.style.display = 'block';
        activeForm.value = "delete";
    }

    const defaultConfig = {
        title: "Dashboard",
        top: "+ New Staff Member",
        action: toggleNewAdminForm,
        formtitle: "Add New Staff Member",
        subtitle: "Add a new staff member to the database",
        save: "Save"
    }
    const pageConfig = {
        students: {
            title: "Manage Students",
            top: "+ New Student",
            action: toggleNewForm,
            formtitle: "New Student",
            subtitle: "Add a new student to the system",
            save: "Add Student"
        },
        tutors: {
            title: "Manage Tutors",
            top: "+ New Tutor",
            action: toggleNewForm,
            formtitle: "New Tutor",
            subtitle: "Add a new tutor to the system",
            save: "Add Tutor"
        },
        schedule: {
            title: "Schedule",
            top: "+ New Class",
            action: toggleNewClassForm,
            formtitle: "Add Class",
            subtitle: "Add a new class to the schedule",
            save: "Save Class"
        },
        subjects: {
            title: "Subjects",
            top: "+ New Subject",
            action: toggleNewClassForm,
            formtitle: "New Subject",
            subtitle: "Add a new subject",
            save: "Save Subject"
        }
    };

    const config = {
        ...defaultConfig,
        ...pageConfig[page] || {}
    };

    if(config){
        if(pageHeading) pageHeading.innerHTML = config.title;
        if(headerBtn) {
            headerBtn.innerHTML = config.top;
            headerBtn.addEventListener("click", () => {
                openForm();
                config.action();
        });
        }
        if(formTitle) formTitle.innerHTML = config.formtitle;
        if(formSubTitle) formSubTitle.innerHTML = config.subtitle;
        if(formSaveBtn) formSaveBtn.innerHTML = config.save;
    }
    
    
    
    

    let overlay = document.getElementById("modalOverlay");
    let cancel = document.getElementById("cancel-form-btn");
    let exitForm = document.getElementById("modal-x");
    let classes = document.querySelectorAll(".class-slot");
    
    let filter = document.getElementById("table-filter");
    let table = document.getElementById("ViewAllTable");
    
    if(overlay){
       overlay.addEventListener("click", handleOverlay); 
    }
    if(cancel){
       cancel.addEventListener("click", closeForm); 
    }
    if(exitForm){
        exitForm.addEventListener("click", closeForm);
    }
    function openForm()
    {
        overlay.classList.add('active');
        updateScrollState();
    }
    let form = document.getElementById("common-form");
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
                    toggleAddStudentToClassForm();
                    let classid = document.getElementById("ClassID");
                    if(classid){
                        classid.value = el.dataset.id;
                    }
                }, 100); 
            }
        )});
    }

    let tutorSelect = document.getElementById("FormTutor");
    if(tutorSelect){
        tutorSelect.addEventListener("change", (e) => {
            filterForm(e.target.value, "tutorChanged", subjectSelect);
        });
    }
    

    let subjectSelect = document.getElementById("FormSubject");
    if(subjectSelect){
        subjectSelect.addEventListener("change", (e) => {
            filterForm(e.target.value, "subjectChanged", tutorSelect);
        });
    }

    let roomSelect = document.getElementById("FormRoom");
    let daySelect = document.getElementById("FormDay");
    let timeSelect = document.getElementById("FormTime");
    
    if(roomSelect){
        roomSelect.addEventListener("change", (e) => {
            filterForm(e.target.value, "roomChanged", daySelect);
        });
    }
    if(daySelect){
        daySelect.addEventListener("change", (e) => {
            filterForm(e.target.value, "dayChanged", timeSelect);
        });
    }

    function filterForm(id, action, dropdown) {
        if (id == "" || id == undefined) {
            return;
        } 
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                dropdown.innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET","../forms/form-filtering.php?action="+action+"&id="+id,true);
        xmlhttp.send();
    }

    let msg = document.getElementById("toast");
    if(msg){
        setTimeout(() => msg.classList.remove("show"), 3000);
    }

    
    
    
    function filterTable(tableId, q){
        let rows = document.querySelectorAll('#' + tableId + ' tbody tr');
        rows.forEach(r => { 
            r.style.display = r.textContent.toLowerCase().includes(q.toLowerCase())?'':'none';
        });
    }

    if(filter){
        filter.addEventListener("input", (e) => {
            filterTable("ViewAllTable", e.target.value)
        });
    }
    

    if(table){
        let editButtons = document.querySelectorAll(".edit-btn");
        let deleteButtons = document.querySelectorAll(".delete-btn");
        
        editButtons.forEach(b => {
            b.addEventListener("click", (e) => {
                document.querySelector('[name="update-id"]').value = b.dataset.id;
                document.querySelector('[name="firstname"]').value = b.dataset.firstname;
                document.querySelector('[name="surname"]').value = b.dataset.surname;
                document.querySelector('[name="email"]').value = b.dataset.email;
                document.querySelector('[name="phone"]').value = b.dataset.phone;
                if(page === "tutors"){
                    document.querySelector('[name="rate"]').value = "€" + b.dataset.rate;
                }
                toggleUpdateForm();
                openForm();
            });
        });

        deleteButtons.forEach(d => {
            d.addEventListener("click", () => {
                document.querySelector('[name="remove-id"]').value = d.dataset.id;
                let name = d.dataset.firstname + " " + d.dataset.surname;
                toggleDeleteForm();
                document.getElementById("remove-msg").innerText = "Are you sure you wish to remove " +
                name + " from the system ?";
                openForm();
            });
            
        });
    }
    
});
