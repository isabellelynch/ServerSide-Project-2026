// ----------------------------------------------------------------------------------GRIND BOOKING SYS-------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------ISABELLE LYNCH---------------------------------------------------------------------------------------------
window.addEventListener("DOMContentLoaded", () => {
    let page = document.body.dataset.page;
    
    //--------------------------------------------------DEFAULT PAGE CONFIGS - MAIN HEADING, TOP RIGHT BUTTON AND FORM SAVE BUTTON---------------------------------------------------------------
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

    let formSaveBtn = document.getElementById("save-btn");
    let headerBtn = document.getElementById("top-bar-btn");
    let pageHeading = document.getElementById("topbarTitle");

    if(config){
        if(pageHeading) pageHeading.innerHTML = config.title;
        if(headerBtn) headerBtn.innerHTML = config.top;
        if(formSaveBtn) formSaveBtn.innerHTML = config.save;      
    }
    
    //--------------------------------------------------------------------FORM BODIES AND OPENING FORMS------------------------------------------------------------------------------------------
    //FORM BODIES
    let bookclassFormBody = document.getElementById("book-for-student");
    let newClassFormBody = document.getElementById("add-new-class");
    let removeFormBody = document.getElementById("remove");
    let newOrUpdateForm = document.getElementById("new-or-update-form");
    let newAdminForm = document.getElementById("new-admin-form");
    let newSubjectForm = document.getElementById("new-subject-form");
    let activeForm = document.getElementById("activeForm");
    let formBodies = [bookclassFormBody, newClassFormBody, removeFormBody, newOrUpdateForm, newAdminForm, newSubjectForm];

    //DYNAMIC FORM ATTRIBUTES - CHANGED ON EACH FORM DISPLAY
    let formTitle = document.getElementById("modalTitle");
    let formSubTitle = document.getElementById("modalSub");
    let overlay = document.getElementById("modalOverlay");

    function showForm(show, hide, active, title, sub){
        // show the chosen form body and hide all the others on this page
        formBodies.forEach(body => {
            if(!body) return;
            if(body === show){
                body.classList.add("showthisform");
                body.classList.remove("dontshow");
            }
            else{
                body.classList.add("dontshow");
                body.classList.remove("showthisform");
            }
        });

        activeForm.value = active;
        localStorage.setItem("activeForm", active);

        formTitle.innerHTML = title;
        formSubTitle.innerHTML = sub;
        formSaveBtn.innerHTML = title;

        overlay.classList.add('active');

        updateScrollState();
    }

    let showAdmin = () => {showForm(newAdminForm, bookclassFormBody, "new-admin", "Add Staff Member", "Add a new staff member to the system");};
    let showNewTutor = () => {showForm(newOrUpdateForm, removeFormBody, "new", "Add Tutor", "Add a new Tutor to the system");};
    let showNewStudent = () => {showForm(newOrUpdateForm, removeFormBody, "new", "Add Student", "Add a new Student to the system");};
    let showUpdateTutor = () => {showForm(newOrUpdateForm, removeFormBody, "update", "Update Tutor", "Amend the chosen Tutors details.");};
    let showUpdateStudent = () => {showForm(newOrUpdateForm, removeFormBody, "update", "Update Student", "Amend the chosen Students details.");};
    let showBookingSchedulePage = () => {showForm(bookclassFormBody, newClassFormBody,  "add", "Make Booking", "Book a class for a student");};
    let showNewClass = () => {showForm(newClassFormBody, bookclassFormBody,  "new-class", "Add Class", "Add a class to the schedule.");};
    let showBookingDashboardPage = () => {showForm(bookclassFormBody, newAdminForm, "add", "Add Booking", "Book a class for a student");};
    let showNewSubject = () => {showForm(newSubjectForm, removeFormBody, "new-subject", "Add Subject", "Add a new subject to the system");};
    
    //TOP RIGHT BUTTON - DISPLAYS MAIN FORM ON EACH PAGE
    if(headerBtn){
        headerBtn.addEventListener("click", () => {
            if(page === "index"){
                showAdmin();
            }
            if(page === "tutors"){
                showNewTutor();
            }
            if(page === "students"){
                showNewStudent();
            }
            if(page === "schedule"){
                showNewClass();
            }
            if(page === "subjects"){
                showNewSubject();
            }
        });
    }
    
    //FORM CONTAINER
    if(overlay){
       overlay.addEventListener("click", handleOverlay); 
    }
    //CANCEL BUTTON - BOTTOM LEFT OF FORM
    let cancel = document.getElementById("cancel-form-btn");
    if(cancel){
       cancel.addEventListener("click", closeForm); 
    }
    //EXIT BUTTON - TOP RIGHT HAND CORNER OF FORM
    let exitForm = document.getElementById("modal-x");
    if(exitForm){
        exitForm.addEventListener("click", closeForm);
    }

    let form = document.getElementById("common-form");
    function closeForm()
    {
        formBodies.forEach(body => { if(body) body.className = ""; });
        if(!overlay) return;
        overlay.classList.remove('active');
        updateScrollState();
        // clear the pop-up form's fields so the next form opens empty
        document.querySelectorAll("#common-form input").forEach(input => {
            input.value = "";
        });
        document.querySelectorAll("#common-form select").forEach(select => {
            select.selectedIndex = 0;
        });
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

    //-------------------------------------------------------------HANDLING THE CLICK OF A CLASS ON THE SCHEDULE TO ADD A STUDENT-------------------------------------------------------------
    let classes = document.querySelectorAll(".class-slot");
    if(classes){
        classes.forEach(el => {
            el.addEventListener("click", () => {
                setTimeout(() => {
                    if(newAdminForm){
                        showBookingDashboardPage();
                    }
                    if(newClassFormBody){
                        showBookingSchedulePage();
                    }
                    
                    let classid = document.getElementById("ClassID");
                    if(classid){
                        classid.value = el.dataset.id;
                    }
                }, 100); 
            }
        )});
    }

    //-----------------------------------------------------HANDLE THE FILTERING OF INPUTS IN THE ADD NEW CLASS FORM (SCHEDULE PAGE)--------------------------------------------------------------

    function filterForm(id, action, dropdown, extra = null) {
         if (id == "" || id == undefined) {
            return;
        } 

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                dropdown.innerHTML = this.responseText;
            }
        }

        let url = "../forms/form-filtering.php?action=" + action + "&id=" + id;

        if (extra !== null) {
            url += "&room=" + extra;
        }

        xmlhttp.open("GET", url, true);
        xmlhttp.send();
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

    let daySelect = document.getElementById("FormDay");
    let roomSelect = document.getElementById("FormRoom");
    let timeSelect = document.getElementById("FormTime");
    if(roomSelect){
        roomSelect.addEventListener("change", (e) => {
            filterForm(e.target.value, "roomChanged", daySelect);
            // a new room means the day and time have to be chosen again
            timeSelect.innerHTML = "<option value='' disabled selected hidden>Select a day first...</option>";
        });
    }
    
    if(daySelect){
        daySelect.addEventListener("change", (e) => {
            let room = roomSelect.value;
            filterForm(e.target.value, "dayChanged", timeSelect, room);
        });
    }

    //--------------------------------------------------------------------------------------POP UP ERROR MESSAGE-------------------------------------------------------------------------------

    let msg = document.getElementById("toast");
    if(msg){
        setTimeout(() => {msg.classList.remove("show")},3000);
    }
    let msgTitle = document.getElementById("toastTitle");
    if(msgTitle){
        if(msgTitle.innerHTML == "Success"){
            closeForm();
        }
        else{
            // the save failed - reopen the same form so the user can correct it.
            // PHP has already put back the values they typed (apart from the field that was invalid).
            let active = localStorage.getItem("activeForm");
            let reopened = true;

            if(active === "new-admin" && page === "index"){
                showAdmin();
            }
            else if(active === "add" && page === "index"){
                showBookingDashboardPage();
            }
            else if(active === "add" && page === "schedule"){
                showBookingSchedulePage();
            }
            else if(active === "update" && (page === "students" || page === "tutors")){
                const saved = localStorage.getItem("editFormData");
                if(saved){
                    const thisdata = JSON.parse(saved);
                    document.querySelector('[name="update-id"]').value = thisdata.id;
                    // refill any field PHP cleared because it was invalid, using the original value
                    const fields = {firstname: thisdata.firstname, surname: thisdata.surname,
                                    email: thisdata.email, phone: thisdata.phone};
                    for (const [name, value] of Object.entries(fields)){
                        const input = document.querySelector('[name="' + name + '"]');
                        if(input && input.value === "") input.value = value ?? "";
                    }
                    if(page === "tutors"){
                        const rate = document.querySelector('[name="rate"]');
                        const subject = document.querySelector('[name="subject"]');
                        if(rate && !rate.value) rate.value = thisdata.rate ?? "";
                        if(subject && !subject.value) subject.value = thisdata.subject ?? "";
                    }
                }
                page === "tutors" ? showUpdateTutor() : showUpdateStudent();
            }
            else if(active === "new" && page === "students"){
                showNewStudent();
            }
            else if(active === "new" && page === "tutors"){
                showNewTutor();
            }
            else if(active === "new-class" && page === "schedule"){
                showNewClass();
            }
            else if(active === "new-subject" && page === "subjects"){
                showNewSubject();
            }
            else{
                // e.g. a failed delete - just show the message
                reopened = false;
            }

            if(reopened) overlay.classList.add("active");
        }
    }
    
    //------------------------------------------------------------TABLE SEARCH BAR ON TUTORS AND STUDENTS PAGES----------------------------------------------------------------------------------
    function filterTable(tableId, q){
        let rows = document.querySelectorAll('#' + tableId + ' tbody tr');
        rows.forEach(r => { 
            r.style.display = r.textContent.toLowerCase().includes(q.toLowerCase())?'':'none';
        });
    }

    let filter = document.getElementById("table-filter");
    if(filter){
        filter.addEventListener("input", (e) => {
            filterTable("ViewAllTable", e.target.value)
        });
    }
    
    //------------------------------------------------------EDIT AND DELETE BUTTON HANDLERS ON STUDENT AND TUTOR TABLES---------------------------------------------------------------------------
    let table = document.getElementById("ViewAllTable");
    if(table){
        let editButtons = document.querySelectorAll(".edit-btn");
        let deleteButtons = document.querySelectorAll(".delete-btn");
        
        editButtons.forEach(b => {
            b.addEventListener("click", () => {
                const persondata = {
                    id: b.dataset.id,
                    firstname: b.dataset.firstname,
                    surname: b.dataset.surname,
                    email: b.dataset.email,
                    phone: b.dataset.phone,
                    rate: b.dataset.rate,
                    subject: b.dataset.subject,
                    page: page
                };

                localStorage.setItem("editFormData", JSON.stringify(persondata));

                document.querySelector('[name="update-id"]').value = b.dataset.id;
                document.querySelector('[name="firstname"]').value = b.dataset.firstname;
                document.querySelector('[name="surname"]').value = b.dataset.surname;
                document.querySelector('[name="email"]').value = b.dataset.email;
                document.querySelector('[name="phone"]').value = b.dataset.phone;

                if(b.dataset.rate){
                    document.querySelector('[name="rate"]').value = b.dataset.rate;
                }
                if(b.dataset.subject){
                    document.querySelector('[name="subject"]').value = b.dataset.subject;
                }
                
                showForm(newOrUpdateForm, removeFormBody, "update", 
                    page === "tutors" ? "Update Tutor" : "Update Student",
                    page === "tutors" ? "Update the chosen Tutors details." : "Update the chosen Students details."
                );
            });
        });

        deleteButtons.forEach(d => {
            d.addEventListener("click", () => {
                document.querySelector('[name="remove-id"]').value = d.dataset.id;
                let name = d.dataset.name;
                if(page === "tutors"){
                    showForm(removeFormBody, newOrUpdateForm, "delete", "Remove Tutor", "Please confirm tutor removal");
                    formSaveBtn.innerHTML = "Remove Tutor";
                }
                if(page === "students"){
                    showForm(removeFormBody, newOrUpdateForm, "delete", "Remove Student", "Please confirm student removal");
                    formSaveBtn.innerHTML = "Remove Student";
                }
                if(page === "subjects"){
                    showForm(removeFormBody, newSubjectForm, "delete", "Remove Subject", "Please confirm subject removal");
                    formSaveBtn.innerHTML = "Remove Subject";
                }
                document.getElementById("remove-msg").innerText = "Are you sure you wish to remove " + name + " from the system?";
            });
            
        });
    }

    
});
