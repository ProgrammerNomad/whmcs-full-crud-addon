<h2>My CRUD</h2>

<div class="crud-actions">
    <a href="?module=mycrud&action=create" class="btn btn-primary">Create New</a>
</div>

<link href="{$WEB_ROOT}/modules/addons/mycrud/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

<script src="{$WEB_ROOT}/modules/addons/mycrud/js/jquery-3.7.1.min.js"></script>
<script src="{$WEB_ROOT}/modules/addons/mycrud/js/jquery.dataTables.min.js"></script>

<table id="myTable" class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Value</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    {foreach from=$data item=item}
        <tr>
            <td>{$item.id}</td>
            <td>{$item.name}</td>
            <td>{$item.value}</td>
            <td>
                <a href="?module=mycrud&action=update&id={$item.id}" class="btn btn-sm btn-warning">Edit</a>
                <a href="?module=mycrud&action=delete&id={$item.id}" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</a>
            </td>
        </tr>
    {/foreach}
    </tbody>
</table>

<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
    });
</script>