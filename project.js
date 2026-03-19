// JavaScript Document

window.addEventListener("DOMContentLoaded", () => 
{
    let AddStudentForm = document.getElementById("StudentFormContainer");
    let Overlay = document.getElementById("overlay");
    
    let RemovalButton = document.getElementById("PermanentRemoval");
    

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
        if(operation == "Update"){
            RemovalButton.style.display = 'block';
        }
        window.location.href = "?Operation=" + operation;
        document.getElementById("StudentOperationButton").innerText = operation + "Student";

        
        openModal();
        
    }

    if(CloseFormButton)
    {
        CloseFormButton.addEventListener("click", closeModal);
    }    
    
    if(AddStudentFormButton)
    {
        AddStudentFormButton.addEventListener("click", () => showForm("Add"));
    }

    
    
    
    
    let editButtons = document.querySelectorAll(".edit");

    editButtons.forEach(button => button.addEventListener("click", EditButtonClick));
    
    function EditButtonClick()
    {
        let id = this.dataset.id;
        showForm("Update"); 
    }
    
    
    let rows = document.querySelectorAll("#table tr");
    
    rows.forEach(row => row.addEventListener("click", RowClick));
    
    function RowClick()
    {
        rows.forEach(r => r.classList.remove("selected"));
        this.classList.add("selected");
    }

});

