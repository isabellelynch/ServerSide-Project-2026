// JavaScript Document

window.addEventListener("DOMContentLoaded", () => 
{
    let AddStudentForm = document.getElementById("StudentFormContainer");
    let Overlay = document.getElementById("overlay");
    let Removal = document.getElementById("PermanentRemoval");

    if(Removal && getOperationButtonText() == "Update Student"){
        Removal.style.display = "block";
    }
    else if(Removal){
        Removal.style.display = "none";
    }
    

    let CloseFormButton = document.getElementById("closeForm");

    let UpdateStudentButton = document.getElementById("UpdateStudent");
    let AddStudentFormButton = document.getElementById("ShowForm");

    function openModal() {
        Overlay.style.display = "block";
        AddStudentForm.style.display = "block";
    }

    function closeModal() {
        Overlay.style.display = "none";
        AddStudentForm.style.display = "none";
    }

    function showForm(operation)
    {
        window.location.href = "?Operation=" + operation;
        openModal();
    }


    function getOperationButtonText(){
        return document.getElementById("StudentOperationButton").innerText;
    }

    if(CloseFormButton)
    {
        CloseFormButton.addEventListener("click", closeModal);
    }    
    
    if(AddStudentFormButton)
    {
        AddStudentFormButton.addEventListener("click", () => {
            showForm("Add");
            document.getElementById("PermanentRemoval").style.display = "none";
        }
        );
    }

    
    
    
    
    let editButtons = document.querySelectorAll(".edit");

    editButtons.forEach(button => button.addEventListener("click", () => { 
        let id = button.dataset.id;
        showForm("Update&id=" + id);
        document.getElementById("PermanentRemoval").style.display = "block";
    })
    );
    
    
    let rows = document.querySelectorAll("#table tr");
    
    rows.forEach(row => row.addEventListener("click", RowClick));
    
    function RowClick()
    {
        rows.forEach(r => r.classList.remove("selected"));
        this.classList.add("selected");
    }


    document.querySelectorAll('.toggle').forEach(item => {
    item.addEventListener('click', function(e) {
        const parent = this.parentElement;
        const dropdown = parent.querySelector('.dropdown');

        if (dropdown) {
        e.preventDefault();
        dropdown.classList.toggle('open');
        }
    });
    });


});

