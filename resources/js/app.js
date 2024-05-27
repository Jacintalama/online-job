import './bootstrap';


document.addEventListener('DOMContentLoaded', function() {
    const yesButton = document.getElementById('yesButton');
    const noButton = document.getElementById('noButton');
    const datePickerDiv = document.getElementById('datePickerDiv');
    const startDateInput = document.getElementById('start_date_job');
    document.querySelector('form').addEventListener('submit', function(e) {
        if (!document.getElementById('role').value) {
            e.preventDefault();
            alert('Please select a role before logging in.'); // Displaying alert
            // Alternatively, display a custom error message on the page
            // document.getElementById('roleError').classList.remove('hidden');
        }
    });
    $(document).ready(function(){
        $('.message-row').hover(
            function() {
                $(this).find('.delete-btn form').removeClass('hidden'); // Show delete button on hover
            }, function() {
                $(this).find('.delete-btn form').addClass('hidden'); // Hide delete button when not hovering
            }
        );

        $('.message-row').click(function(e) {
            if (!$(e.target).is('.delete-btn, .delete-btn *')) { // If clicked element is not delete button or its children
                window.location = $(this).data('url');  // Navigate to message URL
            }
        });
        $('#select_all').change(function() {
            $('.select_message').prop('checked', $(this).prop('checked'));
        });

        $('.select_message').change(function() {
            if ($('.select_message:checked').length == $('.select_message').length) {
                $('#select_all').prop('checked', true);
            } else {
                $('#select_all').prop('checked', false);
            }
        });

        $('#delete_selected').click(function(e) {
            e.preventDefault();

            var selected = [];
            $('.select_message:checked').each(function() {
                selected.push($(this).val());
            });
            console.log('Selected message IDs: ', selected);
            if (selected.length > 0 && confirm('Are you sure?')) {
                console.log({
                    _token: $('meta[name=csrf-token]').attr('content'),

                    message_ids: selected.join(',')
                });
                $.ajax({
                    url: '{{ route("messages.destroy") }}',

                    method: 'DELETE',
                    data: {
                        _token: $('meta[name=csrf-token]').attr('content'),

                        message_ids: selected.join(',')
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(response) {
                        alert('Error deleting messages');
                    }
                });
            }
        });
    });





    yesButton.addEventListener('change', function() {
        if (yesButton.checked) {
            datePickerDiv.style.display = 'block';
            startDateInput.disabled = false; // enable the input
        }
    });

    noButton.addEventListener('change', function() {
        if (noButton.checked) {
            datePickerDiv.style.display = 'none';
            startDateInput.disabled = true;  // disable the input
        }
    });

    var myModal = new bootstrap.Modal(document.getElementById('messageModal'));




    $(document).ready(function() {
        $('.count').each(function () {
            var targetNumber = parseInt($(this).text());  // Get the target number
            $(this).prop('Counter', Math.floor(Math.random() * targetNumber)).animate({
                Counter: targetNumber
            }, {
                duration: 3000,
                easing: 'swing',
                step: function (now) {
                    $(this).text(Math.ceil(now));
                }
            });
        });
    });


    $(document).ready(function(){
        $('.list-group-item').on('click', function(){
            $('.list-group-item').removeClass('active'); // Remove active class from all items
            $(this).addClass('active'); // Add active class to the clicked item
        });
    });





});



// function toggleJobDetails(targetId) {
//     let target = $(targetId);
//     if(target.hasClass('active-job')) {
//         // If the job details is currently active, hide it
//         target.removeClass('active-job').fadeOut();
//     } else {
//         // If the job details is not active, show it and hide others
//         $('.job-details.active-job').removeClass('active-job').fadeOut();
//         target.addClass('active-job').fadeIn();
//     }
// }







