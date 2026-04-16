window.addEventListener("DOMContentLoaded", () => {
    let page = document.body.dataset.page;
    let formTitle = document.getElementById("modalTitle");
    let formSubTitle = document.getElementById("modalSub");
    let formSaveBtn = document.getElementById("save-btn");
    let headerBtn = document.getElementById("top-bar-btn");
    let pageHeading = document.getElementById("topbarTitle");
    let overlay = document.getElementById("modalOverlay");
    const defaultConfig = {
        title: "Dashboard",
        top: "+ New Staff Member",
        save: "Save"
    }
    const pageConfig = {
        students: {
            title: "Manage Students",
            top: "+ New Student",
            save: "Add Student"
        },
        tutors: {
            title: "Manage Tutors",
            top: "+ New Tutor",
            save: "Add Tutor"
        },
        schedule: {
            title: "Schedule",
            top: "+ New Class",
            save: "Save Class"
        },
        subjects: {
            title: "Subjects",
            top: "+ New Subject",
            save: "Save Subject"
        }
    };

    const config = {
        ...defaultConfig,
        ...pageConfig[page] || {}
    };

    if(config){
        if(pageHeading) pageHeading.innerHTML = config.title;
        if(headerBtn) headerBtn.innerHTML = config.top;
        if(formSaveBtn) formSaveBtn.innerHTML = config.save;      
    }
    

    let bookclassFormBody = document.getElementById("book-for-student");
    let newClassFormBody = document.getElementById("add-new-class");
    let removeFormBody = document.getElementById("remove");
    let newOrUpdateForm = document.getElementById("new-or-update-form");
    let newAdminForm = document.getElementById("new-admin-form");

    let activeForm = document.getElementById("activeForm");

    function showForm(show, hide, active, title, sub){
        if(show.classList.contains("dontshow")){
            show.classList.remove("dontshow");
        }
        show.classList.add("showthisform");

        if(hide.classList.contains("showthisform")){
            hide.classList.remove("showthisform");
        }
        hide.classList.add("dontshow");
        activeForm.value = active;
        formTitle.innerHTML = title;
        formSubTitle.innerHTML = sub;
        overlay.classList.add('active');
        updateScrollState();
    }


    if(newAdminForm && newAdminForm.classList.contains("showthisform")){
        showForm(newAdminForm, bookclassFormBody, "new-admin", "New Staff Member", "Add a new staff member to the system");
    }
    if(bookclassFormBody && bookclassFormBody.classList.contains("showthisform")){
        showForm(bookclassFormBody, newAdminForm, "add", "Make Booking", "Add student to class list");
    }
    if(page === "tutors"){
        if(newOrUpdateForm && newOrUpdateForm.classList.contains("showthisform")){
            showForm(newOrUpdateForm, removeFormBody, "new", "New Tutor", "Add a new Tutor to the system");
        }
        if(removeFormBody && removeFormBody.classList.contains("showthisform")){
            showForm(removeFormBody, newOrUpdateForm, "remove", "Remove Tutor", "Remove tutor from the system.");
        }
    }
    
    

    headerBtn.addEventListener("click", () => {
        if(page === "index"){
            showForm(newAdminForm, bookclassFormBody, "new-admin", "New Staff Member", "Add a new staff member to the system");
        }
        if(page === "tutors"){
            showForm(newOrUpdateForm, removeFormBody, "new", "New Tutor", "Add a new Tutor to the system");
        }
        if(page === "students"){
            showForm(newOrUpdateForm, removeFormBody, "new", "New Student", "Add a new Student to the system");
        }
        if(page === "schedule"){
            showForm(newClassFormBody, bookclassFormBody, "new-class", "New Class", "Add a new class to the schedule.");
        }
    });
 
    
    
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

    let form = document.getElementById("common-form");
    function closeForm()
    {
        if(page === "index"){
            newAdminForm.className = "";
            bookclassFormBody.className = "";
        }
        if(page === "tutors"){
            removeFormBody.className = "";
            newOrUpdateForm.className = "";
        }
        if(page === "schedule"){
            newClassFormBody.className = "";
            bookclassFormBody.className = "";
        }
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
                    if(newAdminForm){
                        showForm(bookclassFormBody, newAdminForm, "add", "Make Booking", "Add student to class list"); 
                    }
                    if(newClassFormBody){
                        showForm(bookclassFormBody, newClassFormBody, "add", "Make Booking", "Add student to class list"); 
                    }
                    
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
        setTimeout(() => {msg.classList.remove("show")},3000);
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
                if(page == "tutors"){
                    document.querySelector('[name="rate"] option').innerHTML = "€" + b.dataset.rate;
                    showForm(newOrUpdateForm, removeFormBody, "update", "Update Tutor", "Make the necessary changes to tutors details");
                    formSaveBtn.innerHTML = "Update Tutor";
                }
                if(page === "students"){
                    showForm(newOrUpdateForm, removeFormBody, "update", "Update Student", "Make the necessary changes to students details");
                    formSaveBtn.innerHTML = "Update Student";
                }
            });
        });

        deleteButtons.forEach(d => {
            d.addEventListener("click", () => {
                document.querySelector('[name="remove-id"]').value = d.dataset.id;
                let name = d.dataset.firstname + " " + d.dataset.surname;
                if(page == "tutors"){
                    showForm(removeFormBody, newOrUpdateForm, "delete", "Remove Tutor", "Please confirm tutor removal");
                    formSaveBtn.innerHTML = "Remove Tutor";
                }
                if(page === "students"){
                    showForm(removeFormBody, newOrUpdateForm, "delete", "Remove Student", "Please confirm student removal");
                    formSaveBtn.innerHTML = "Remove Student";
                }
                document.getElementById("remove-msg").innerText = "Are you sure you wish to remove " + name + " from the system ?";
            });
            
        });
    }
    
});
