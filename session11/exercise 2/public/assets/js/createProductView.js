const priceInput = document.getElementById("priceInput");
const tracker = document.getElementById("priceTracker");

priceInput.addEventListener("input", () => {
  const value = parseFloat(priceInput.value);

  if (value <= 0 || isNaN(value)) {
    tracker.textContent = "Price must be greater than 0";
  } else {
    tracker.textContent = "";
  }
});
