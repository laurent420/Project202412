<!-- Include Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<!-- Your HTML Form with Dropdown Calendar -->
<form action="{{ route('saveDate') }}" method="POST">
    @csrf
    <label for="datepicker">Select Date:</label>
    <input type="text" id="datepicker" name="selected_date">

    <button type="submit">Save</button>
</form>

<!-- Include Flatpickr JS and Initialize -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("#datepicker", {
        dateFormat: "Y-m-d", // Set desired date format
        enableTime: false,    // Disable time selection
        // Additional configurations...
    });
</script>
