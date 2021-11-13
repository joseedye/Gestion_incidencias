$(function(){
    $('[data-category]').on('click', editCategoryModal);
    $('[data-level]').on('click', editLevelModal);
});

function editCategoryModal(){
    var category_id =$(this).data('category');
    $('#category_id').val(category_id);

    var category_name =$(this).parent().prev().text();
    $('#category_name').val(category_name);
    $('#modalEditCategory').modal('show');
}

function editLevelModal(){
    var level_id =$(this).data('level');
    $('#level_id').val(level_id);

    var level_name =$(this).parent().prev().text();
    $('#level_name').val(level_name);
    $('#modalEditLevel').modal('show');
}