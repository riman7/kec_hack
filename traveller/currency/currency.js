// Define the conversion rates for different currencies (example rates)
const conversionRates = {
    'USD': 120,   // Example: 1 USD = 120 NPR
    'EUR': 130,   // Example: 1 EUR = 130 NPR
    'GBP': 150,   // Example: 1 GBP = 150 NPR
    'NPR': 1      // 1 NPR = 1 NPR
};

async function displayLiveConversionRate() {
    const selectedCurrency = document.getElementById('currencySelect').value;

    // Fetch live conversion rate
    const rate = await fetchExchangeRate('NPR', selectedCurrency);
    const conversionRate = rate || conversionRates[selectedCurrency]; // Fallback to default rate if API fails

    // Display the live conversion rate below the result
    document.getElementById('liveConversionRate').innerText = `Live Conversion Rate: 1 NPR = ${conversionRate} ${selectedCurrency}`;
}

// Polygon API key and URL
const apiKey = '9EGNaWbvJ0W2acjV3PdKYZOqVsvFx_l4';  // Replace with your Polygon API key

async function fetchExchangeRate(fromCurrency, toCurrency) {
    const url = `https://api.polygon.io/v2/aggs/ticker/C:${fromCurrency}${toCurrency}/prev?apiKey=${apiKey}`;
    const response = await fetch(url);
    const data = await response.json();
    return data.results[0].c;
}

async function convertCurrency() {
    const inputAmount = document.getElementById('inputAmount').value;
    const selectedCurrency = document.getElementById('currencySelect').value;

    if (!inputAmount) {
        document.getElementById('conversionResult').innerText = 'Please enter a valid amount.';
        return;
    }

    // Convert based on selected currency
    const result = await fetchExchangeRate('NPR', selectedCurrency);
    const conversionRate = result || conversionRates[selectedCurrency]; // Fallback to default rate if API fails
    const convertedAmount = inputAmount * conversionRate;

    document.getElementById('conversionResult').innerText = `${inputAmount} NPR = ${convertedAmount.toFixed(2)} ${selectedCurrency}`;

}

document.getElementById('convertBtn').addEventListener('click', convertCurrency);
