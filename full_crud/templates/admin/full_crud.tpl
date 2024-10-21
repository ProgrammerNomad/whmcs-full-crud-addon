<h2>Full CRUD</h2>

<div class="crud-actions">
    <a href="?module=full_crud&action=create" class="btn btn-primary">Create New</a>
</div>

<link href="{$WEB_ROOT}/modules/addons/full_crud/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

<script src="{$WEB_ROOT}/modules/addons/full_crud/js/jquery-3.7.1.min.js"></script>
<script src="{$WEB_ROOT}/modules/addons/full_crud/js/jquery.dataTables.min.js"></script>

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
                <a href="?module=full_crud&action=update&id={$item.id}" class="btn btn-sm btn-warning">Edit</a>
                <a href="?module=full_crud&action=delete&id={$item.id}" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</a>
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

{if $action eq 'create' || $action eq 'update'}
    <h3>{if $action eq 'create'}Create{else}Update{/if} Data</h3>
    <form method="post" action="?module=full_crud&action={if $action eq 'create'}create{else}update{/if}">
        <input type="hidden" name="id" value="{$data[0].id}">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{$data[0].name}" class="form-control">
        </div>

        <div class="form-group">
            <label for="value">Value:</label>
            <textarea name="value" id="value" class="form-control">{$data[0].value}</textarea>
        </div>

        <input type="submit" value="{if $action eq 'create'}Create{else}Update{/if}" class="btn btn-primary">
    </form>
{/if}