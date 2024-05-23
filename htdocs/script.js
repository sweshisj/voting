const userRatingInput = document.getElementById('user-rating');
const ratingEmoticon = document.getElementById('rating-emoticon');

// Update the rating value and emoticon on input change
userRatingInput.addEventListener('input', function () {
    const value = parseFloat(userRatingInput.value).toFixed(1);
    updateEmoticon(value);
    fillSliderColor();
});

// Update the emoticon based on the rating value
function updateEmoticon(value) {
    if (value >= 4.5) {
        ratingEmoticon.textContent = '😄';
    } else if (value >= 3.5) {
        ratingEmoticon.textContent = '🙂';
    } else if (value >= 2.5) {
        ratingEmoticon.textContent = '😐';
    } else if (value >= 1.5) {
        ratingEmoticon.textContent = '🙁';
    } else {
        ratingEmoticon.textContent = '😞';
    }
}

// Fill the slider color until the previous value
function fillSliderColor() {
    const fillPercentage = (userRatingInput.value - userRatingInput.min) / (userRatingInput.max - userRatingInput.min) * 100;
    userRatingInput.style.background = `linear-gradient(to right, #007bff 0%, #007bff ${fillPercentage}%, #f5f5f5 ${fillPercentage}%, #f5f5f5 100%)`;
}

// Initial update of the emoticon and slider color
updateEmoticon(userRatingInput.value);
fillSliderColor();