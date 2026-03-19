// JavaScript Document

window.addEventListener("DOMContentLoaded", () => 
{
    let AddForm = document.getElementById("studentForm");
    let Overlay = document.getElementById("overlay");
    let CloseFormButton = document.getElementById("closeForm");
    let OpenFormButton = document.getElementById("openForm");
    let AddStudentSubmit = document.getElementById("SubmitAddStudent");
    let AddStudentFormButton = document.getElementById("ShowForm");

    function openModal() {
        Overlay.style.display = "block";
        AddForm.style.display = "block";
    }

    function closeModal() {
        Overlay.style.display = "none";
        AddForm.style.display = "none";
    }
    if(CloseFormButton)
    {
        CloseFormButton.addEventListener("click", closeModal);
    }    
    function showForm(operation)
    {
        window.location.href = "?Operation=" + operation;
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
        showForm("Update&id="+id); 
    }
    
    
    let rows = document.querySelectorAll("#table tr");
    
    rows.forEach(row => row.addEventListener("click", RowClick));
    
    function RowClick()
    {
        rows.forEach(r => r.classList.remove("selected"));
        this.classList.add("selected");
    }

});

