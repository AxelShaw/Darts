// Page Accueil
document.body.innerHTML = `
    <h1>Darts App</h1>
    <div id="result">Chargement...</div>
`;

// Charger les données
async function loadAccueil() {
    const resultDiv = document.getElementById('result');
    
    try {
        const data = await callApi('test');
        
        if (data.success && data.data.length > 0) {
            resultDiv.innerHTML = '✅ API OK !<br>';
            data.data.forEach(row => {
                resultDiv.innerHTML += `<div>${row.Nom}</div>`;
            });
        } else {
            resultDiv.innerHTML = 'Aucune donnée depuis l\'API';
        }
    } catch (error) {
        resultDiv.innerHTML = `Erreur: ${error.message}`;
    }
}

loadAccueil();