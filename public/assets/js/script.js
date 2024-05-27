let currentTab = 0;
showTab(currentTab);

function showTab(n) {
    const tabs = document.getElementsByClassName("tab");
    tabs[n].classList.add("show");
    if (n === 0) {
        document.getElementById("step1").classList.add("active");
    } else if (n === 1) {
        document.getElementById("step2").classList.add("active");
    } else if (n === 2) {
        document.getElementById("step3").classList.add("active");
    }
}

function validateForm() {
    const tabs = document.getElementsByClassName("tab");
    const inputs = tabs[currentTab].getElementsByTagName("input");
    let valid = true;

    for (let i = 0; i < inputs.length; i++) {
        if (inputs[i].value === "") {
            inputs[i].classList.add("invalid");
            valid = false;
        } else {
            inputs[i].classList.remove("invalid");
        }
    }

    return valid;
}

function nextStep(n) {
    if (n === 1 && !validateForm()) return false;

    const tabs = document.getElementsByClassName("tab");
    tabs[currentTab].classList.remove("show");
    currentTab = currentTab + n;
    if (currentTab >= tabs.length) {
        document.getElementById("regForm").submit();
        return false;
    }
    showTab(currentTab);
}
