<!-- Review Sections -->
<section class="px-4 my-16 container mx-auto">
    <button id="openModalBtn"
        class="border-[#EF9831] border-[2px] text-[#EF9831] p-3 px-5 rounded-lg hover:bg-[#EF9831] hover:text-white font-medium">
        Leave a Review
    </button>
    <div class="grid gap-10"></div>
</section>

<?php 
        get_template_part( 'template-parts/review', 'form' ); 
    ?>
<script>
document.getElementById('openModalBtn').addEventListener('click', function() {
    document.getElementById('reviewModal').classList.remove('hidden');
});
document.getElementById('closeModalBtn').addEventListener('click', function() {
    document.getElementById('reviewModal').classList.add('hidden');
});
</script>
