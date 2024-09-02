import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])

//funzione ricerca indirizzo
document.addEventListener('DOMContentLoaded', () => {
    const addressInput1 = document.getElementById('address1');
    const addressInput2 = document.getElementById('address2');
    const addressDiv1 = document.getElementById('addressResult1');
    const addressDiv2 = document.getElementById('addressResult2');
    const resultsContainer1 = document.getElementById('resultsContainer1');
    const resultsContainer2 = document.getElementById('resultsContainer2');
    const apiBaseUrl = 'https://api.tomtom.com/search/2/search/';
    const apiKey = window.apiKey;

    const fetchAddresses = async (query) => {
        try {
            const response = await fetch(`${apiBaseUrl}${query}.json?key=${apiKey}`);
            if (!response.ok) throw new Error('Network response was not ok');
            const data = await response.json();
            return data.results;
        } catch (error) {
            console.error('Error fetching the address:', error);
            return [];
        }
    };

    const updateResults = (results, inputElement, resultsContainer, addressDiv) => {
        resultsContainer.innerHTML = '';
        if (results.length) {
            resultsContainer.style.display = 'block';
            results.forEach(({ address: { freeformAddress } }) => {
                const option = document.createElement('div');
                option.textContent = freeformAddress;
                option.addEventListener('click', () => {
                    inputElement.value = freeformAddress;
                    resultsContainer.style.display = 'none';
                    inputElement.style.display = 'none';
           
                    addressDiv.innerHTML = inputElement.value;
                });
                resultsContainer.appendChild(option);
            });
        } else {
            resultsContainer.style.display = 'none';
        }
    };

    const handleInput = async (inputElement, resultsContainer, addressDiv) => {
        const query = inputElement.value;
        if (query.length < 5) {
            resultsContainer.style.display = 'none';
            resultsContainer.innerHTML = '';
            return;
        }
        const results = await fetchAddresses(query);
        updateResults(results, inputElement, resultsContainer, addressDiv);
    };

    addressInput1.addEventListener('input', () => handleInput(addressInput1, resultsContainer1, addressDiv1));
    addressInput2.addEventListener('input', () => handleInput(addressInput2, resultsContainer2, addressDiv2));

    document.addEventListener('click', (event) => {
        if (!resultsContainer1.contains(event.target) && event.target !== addressInput1) {
            resultsContainer1.style.display = 'none';
        }
        if (!resultsContainer2.contains(event.target) && event.target !== addressInput2) {
            resultsContainer2.style.display = 'none';
        }
    });
});
