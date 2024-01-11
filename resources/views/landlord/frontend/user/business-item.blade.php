@foreach ($businessNameArray as $data)
    <li style='color:#1B434D  !important;background: #ddd; padding: 10px;display: flex;justify-content: space-between;'>
        <span>{{ $data }}</span>
        <span style='color: #1B434D; cursor: pointer;' class='select-business'>
            <i class='fas fa-check-circle'></i>
        </span>
    </li>
@endforeach

<script>
    $('.select-business').click(function() {
        const content = $(this).closest('span').prev().text();
        $('[name="domain"]').val(content.trim().replace(' ', '-').toLowerCase())
        $('#gptModal').modal('hide');
    })
</script>
