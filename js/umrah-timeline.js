$(document).ready(function () {
    var currentStep = 1;
    var totalSteps = 3;

    $('#nextStep').click(function () {
        if (currentStep < totalSteps) {
            $('#step' + currentStep).removeClass('active');
            currentStep++;
            $('#step' + currentStep).addClass('active');
        } else {
            alert('You have completed all the steps!');
        }
    });
});