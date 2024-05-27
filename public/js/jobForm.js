document.addEventListener("DOMContentLoaded", function() {
    document.body.classList.add('loaded');
});
const totalSteps = 7;


function updateProgressBar(step) {
    const progress = document.getElementById('progress');
    const width = (step / totalSteps) * 100;
    progress.style.width = width + '%';
}

function updateCardHeader(step) {
    const cardHeader = document.getElementById('cardHeader');
    switch(step) {
        case 1:
            cardHeader.textContent = 'Add Job Basics';
            break;
        case 2:
            cardHeader.textContent = 'Job Details';
            break;
        case 3:
            cardHeader.textContent = 'Add Salary'; // Updated to reflect the new Step 3
            break;
        case 4:
            cardHeader.textContent = 'Eligibility, Qualification, Trainings'; // Moved from Step 3 to Step 4
            break;
        case 5:
            cardHeader.textContent = 'Add Job Competency'; // Update as needed based on your step names
            break;
        case 6:
            cardHeader.textContent = 'Set Preferences'; // Update as needed based on your step names
            break;
        case 7:
            cardHeader.textContent = 'Review Job Details';
            break;

        default:
            cardHeader.textContent = 'Add Job Basis';
    }
}

function canProceedToNextStep(step) {
    // If TinyMCE is loaded, update the textareas with the latest content
    if (window.tinymce) {
        tinymce.triggerSave();
    }

    const requiredInputs = document.querySelectorAll('#step' + step + ' input[required], #step' + step + ' textarea[required]');
    for (let input of requiredInputs) {
        console.log(input, input.value.trim());
        if (!input.value.trim()) {
            alert('Please fill out all required fields before proceeding.');
            return false;
        }
    }
    return true;
}


function nextStep(step) {
    if (!canProceedToNextStep(step - 1)) return; // Check the current step's fields before moving to the next step

    // 1. Hide all steps
    document.querySelectorAll('.form-step').forEach(el => el.style.display = 'none');

    // 2. Show the desired step
    document.getElementById('step' + step).style.display = 'block';

    // 3. Update the progress bar
    updateProgressBar(step);

    // 4. Update the card header
    updateCardHeader(step);

    if (step === 7) {
        populateReviewDetails();

    }
}

function prevStep(step) {
    // Same logic as nextStep but for going back
    nextStep(step);
}





function populateReviewDetails() {
    console.log("populateReviewDetails is being called");

    // If TinyMCE is loaded, update the textareas with the latest content
    if (window.tinymce) {
        tinymce.triggerSave();
    }

     // Retrieve the position title from the input field with ID 'position_title'
     const position_title = document.getElementById('position_title').value;

     // Retrieve the department name from the readonly input within the 'form-group'
     // Ensure this selector only selects the readonly input for the department name
     const departmentNameElement = document.querySelector('.form-group input[type="text"][readonly]');
     const departmentName = departmentNameElement ? departmentNameElement.value : 'Department name not found';


    const eligibilityDropdown = document.getElementById('eligibility');
    const selectedEligibilityText = eligibilityDropdown.options[eligibilityDropdown.selectedIndex].text;
      // Get the salary grade
      const salaryGrade = document.getElementById('salary_grade').value;
      // Get the monthly salary from the input field directly
      const monthlySalary = document.getElementById('monthly_salary').value;


    // Parse the stringified JSON into a JavaScript object
    const qualificationsData = document.getElementById('qualifications-data').value;
    console.log("Qualifications Data from Hidden Input:", qualificationsData);
    let qualifications = [];


    try {
        qualifications = JSON.parse(qualificationsData);
        console.log("Parsed Qualifications:", qualifications);
         // Filter out any empty qualifications
         qualifications = qualifications.filter(qual => qual.type || qual.requirement || qual.priorityScore);



    } catch (error) {
        console.error("Error parsing qualifications data:", error);
    }
     // Build the HTML string with the qualifications data
     let qualificationsHtml = qualifications.map((qualification, index) => `
     <div style="margin-top: 10px;">
         <strong>Qualification ${index + 1}:</strong>
         <span>Type: ${qualification.type}, Requirement: ${qualification.requirement}, Priority Score: ${qualification.priorityScore}</span>
     </div>
 `).join('');
    const training = document.getElementById('training').value;
    const competency = document.getElementById('competency').value;
    const email = document.getElementById('contact_email').value;
    const phone = document.getElementById('contact_phone').value;
   const genderRequirement = document.getElementById('gender_requirement_select').value;

   // FOR JOB DATE START
   const hasStartDate = document.querySelector('input[name="has_start_date"]:checked').value;
   let startDateJob = "";
   if (hasStartDate === "yes") {
       startDateJob = document.getElementById('start_date_job').value;
   }


  // For Job Types
  let jobTypes = document.querySelectorAll('input[name="job_types[]"]:checked');
  let selectedJobTypes = [];
  jobTypes.forEach(function(jobType) {
    if (jobType.parentElement && jobType.parentElement.textContent) {
        selectedJobTypes.push(jobType.parentElement.textContent.trim());
    } else {
        console.warn("No parent label found or it's empty for", jobType);
    }
});



   // For Job Schedules
   let jobSchedules = document.querySelectorAll('input[name="job_schedules[]"]:checked');
   let selectedJobSchedules = [];
   jobSchedules.forEach(function(jobSchedule) {
    if (jobSchedule.parentElement && jobSchedule.parentElement.textContent) {
        selectedJobSchedules.push(jobSchedule.parentElement.textContent.trim());
    } else {
        console.warn("No parent label found or it's empty for", jobSchedule);
    }
});



  // Format the monthly salary for display
let formattedMonthlySalary = "₱" + monthlySalary.toLocaleString('en-US');

    const JobDeadline = document.getElementById('job_deadline').value;

    let reviewDiv = document.getElementById('reviewDetails');

    console.log("Review Div:", reviewDiv);


    reviewDiv.innerHTML = `
    <div style="font-family: Arial, sans-serif; padding: 20px; background-color: #f7f7f7; border: 1px solid #e0e0e0; border-radius: 5px;">
    <div style="margin-top: 20px;">
        <strong>Position Title:</strong>
        <span>${position_title}</span>
    </div>
    <div style="margin-top: 10px;">
        <strong>Department:</strong>
        <span>${departmentName}</span>
    </div>
    <hr>


      <!-- Salary Details -->
      <div style="margin-top: 10px;">
      <strong>Salary Grade:</strong>
      <span>${salaryGrade}</span>
  </div>
  <div style="margin-top: 10px;">
      <strong>Monthly Salary:</strong>
      <span>${monthlySalary}</span>
  </div>

        <div style="margin-top: 10px;">
            <strong>Type of Employment:</strong>
            <span>${selectedJobTypes.join(', ')}</span>
        </div>

        <div style="margin-top: 10px;">
            <strong>Job Schedule:</strong>
            <span>${selectedJobSchedules.join(', ')}</span>
        </div>
        <strong>Start Date for the Job:</strong> ${startDateJob ? startDateJob : "Not provided"}<br>

        <div style="margin-top: 10px;">
            <strong>Job Deadline:</strong>
            <span>${JobDeadline}</span>
        </div>

        <div style="margin-top: 10px;">
    <strong>Eligibility:</strong>
    <span>${selectedEligibilityText}</span>
        </div>


        <div style="margin-top: 10px;">
            <strong>Qualification:</strong>
            <span>${qualificationsHtml}</span>
        </div>

        <div style="margin-top: 10px;">
            <strong>Training:</strong>
            <span>${training}</span>
        </div>

        <div style="margin-top: 10px;">
            <strong>Competency:</strong>
            <span>${competency}</span>
        </div>

        <div style="margin-top: 10px;">
            <strong>Gender Requirement:</strong>
            <span>${genderRequirement}</span>
        </div>

        <div style="margin-top: 20px; border-top: 1px solid #e0e0e0; padding-top: 10px;">
            <strong>Contact Details</strong><br>
            <i style="color: #007BFF;">📧</i> <strong>Email:</strong> ${email}<br>
            <i style="color: #007BFF;">📞</i> <strong>Phone:</strong> ${phone}
        </div>

    </div>
`;

}



// Initialize by showing the first step
nextStep(1);



