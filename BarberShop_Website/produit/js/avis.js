// Fichier JavaScript : avis.js

document.addEventListener("DOMContentLoaded", () => {
    const avisForm = document.getElementById("avisForm");
    const avisContainer = document.getElementById("avisContainer");

    avisForm.addEventListener("submit", (e) => {
        e.preventDefault();
        const avisTextArea = document.getElementById("avis");
        const avisText = avisTextArea.value;

        if (avisText.trim() !== "") {
            const avisItem = document.createElement("div");
            avisItem.classList.add("avis-item");
            avisItem.innerHTML = `<p><strong>Nom Utilisateur :</strong> ${avisText}</p>`;
            avisContainer.appendChild(avisItem);
            avisTextArea.value = "";
        } else {
            alert("Veuillez saisir un avis valide !");
        }
    });
});


const labels = document.querySelectorAll('.rating label');
labels.forEach(label => {
    label.addEventListener('click', (e) => {
        const clickedRating = e.target.getAttribute('for').replace('star', '');
        console.log('Note attribuée :', clickedRating);
    });
});




