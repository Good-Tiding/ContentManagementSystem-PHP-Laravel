  <script>
    const button = document.getElementById('deleteButton');
    button.addEventListener('click', () => {
        console.log('Delete button clicked');
        fetch("{{ route('user.deleteuserimage', $user) }}", {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
        })
        .then(res => {
            console.log('Response received:', res);
            if (res.ok) {
                console.log('Image deleted successfully');
                location.reload();
            } 
            else 
            {
                console.error('Failed to delete image');
            }
        })
        .catch(error => console.error('Error:', error));
    });
</script> 


{{-- <script>
document.addEventListener('DOMContentLoaded', (event) => {
    const button = document.getElementById('deleteButton');
    const imageDeletedField = document.getElementById('imageDeletedField');

    if (button) {
        button.addEventListener('click', () => {
            console.log('Delete button clicked');

            fetch("{{ route('user.deleteuserimage', $user) }}", {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(res => {
                console.log('Response received:', res);
                if (res.ok) {
                    console.log('Image deleted successfully');
                    if (imageDeletedField) {
                        imageDeletedField.value = 'true';
                    }
                    location.reload();
                } else {
                    console.error('Failed to delete image');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    }
});
</script>
 --}}