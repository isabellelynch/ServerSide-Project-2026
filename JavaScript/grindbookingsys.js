window.addEventListener("DOMContentLoaded", () => {
    let page = document.body.dataset.page;
    
    let formTitle = document.getElementById("modalTitle");
    let formSubTitle = document.getElementById("modalSub");
    let formSaveBtn = document.getElementById("save-btn");
    let headerBtn = document.getElementById("top-bar-btn");
    let pageHeading = document.getElementById("topbarTitle");

    const defaultConfig = {
        title: "Dashboard",
        top: "+ New Class",
        formtitle: "Add Class",
        subtitle: "Add a new class to the schedule",
        save: "Save Class"
    }
    const pageConfig = {
        students: {
            title: "Manage Students",
            top: "+ New Student",
            formtitle: "New Student",
            subtitle: "Add a new student to the system",
            save: "Add Student"
        },
        tutors: {
            title: "Manage Tutors",
            top: "+ New Tutor",
            formtitle: "New Tutor",
            subtitle: "Add a new tutor to the system",
            save: "Add Tutor"
        },
        subjects: {
            title: "Subjects & Schedules",
            top: "+ New Subject",
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
        pageHeading.innerHTML = config.title;
        headerBtn.innerHTML = config.top;
        formTitle.innerHTML = config.formtitle;
        formSubTitle.innerHTML = config.subtitle;
        formSaveBtn.innerHTML = config.save;
    }
    
    

    let overlay = document.getElementById("modalOverlay");
    let cancel = document.getElementById("cancel-form-btn");
    let exitForm = document.getElementById("modal-x");
    let classes = document.querySelectorAll(".class-slot");
    
    let filter = document.getElementById("table-filter");
    let table = document.getElementById("ViewAllTable");

    headerBtn.addEventListener("click", () => {
        toggleNewClassForm();
        openForm();
        
    });
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
                    toggleNewStudentForm();
                    let classid = document.getElementById("ClassID");
                    if(classid){
                        classid.value = el.dataset.id;
                    }
                }, 100); 
            }
        )});
    }

    let bookclassFormBody = document.getElementById("book-for-student");
    let newClassFormBody = document.getElementById("add-new-class");
    let removeStudentFormBody = document.getElementById("remove-student");
    let updateStudentFormBody = document.getElementById("update-student-form");
    let activeForm = document.getElementById("activeForm");

    let tutorSelect = document.getElementById("FormTutor");
    tutorSelect.addEventListener("change", showTutorSubjects(this.value));

    let subjectSelect = document.getElementById("FormSubject");
    let roomSelect = document.getElementById("FormRoom");
    let daySelect = document.getElementById("FormDay");
    let timeSelect = document.getElementById("FormTime");

    function showTutorSubjects(str) {
        if (str == "" || str == undefined) {
            return;
        } 
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                subjectSelect.innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET","../databaseinteractions/tutors.php?id="+str,true);
        xmlhttp.send();
    }

    function toggleNewClassForm(){
        formTitle.innerHTML = "Add Class";
        formSubTitle.innerHTML = "Add a new class to the system";
        bookclassFormBody.style.display = 'none';
        newClassFormBody.style.display = 'block';
        activeForm.value = "new-class";
    }
    function toggleNewStudentForm(){
        formTitle.innerHTML = "Make Booking";
        formSubTitle.innerHTML = "Add student to class list";
        bookclassFormBody.style.display = 'block';
        newClassFormBody.style.display = 'none';
        activeForm.value = "add";
    }
    function toggleUpdateStudentForm(){
        formTitle.innerHTML = "Update Student";
        formSubTitle.innerHTML = "Make the necessary changes to students details";
        formSaveBtn.innerHTML = "Update Student";
        updateStudentFormBody.style.display = 'block';
        removeStudentFormBody.style.display = 'none';
        activeForm.value = "update";
    }
    function toggleDeleteStudentForm(){
        formTitle.innerHTML = "Remove Student";
        formSubTitle.innerHTML = "Please confirm student removal";
        formSaveBtn.innerHTML = "Remove Student";
        updateStudentFormBody.style.display = 'none';
        removeStudentFormBody.style.display = 'block';
        activeForm.value = "delete";
    }

    
    let msgBody = document.getElementById("toastBody");
    if(msgBody.innerText != ""){
        showMsg();
    }

    function showMsg() {
        let msg = document.getElementById("toast");
        msg.classList.add("show");
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
                toggleUpdateStudentForm();
                openForm();
            });
        });

        deleteButtons.forEach(d => {
            d.addEventListener("click", () => {
                document.querySelector('[name="remove-id"]').value = d.dataset.id;
                let name = d.dataset.firstname + " " + d.dataset.surname;
                
                toggleDeleteStudentForm();
                
                document.getElementById("remove-msg").innerText = "Are you sure you wish to remove " +
                name + " from the system ?";
                openForm();
            });
            
        });
    }
    
});

/*
if(error){
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
    }*/