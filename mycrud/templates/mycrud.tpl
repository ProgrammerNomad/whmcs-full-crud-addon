<h2>My CRUD</h2>

<div class="crud-actions">
    <a href="?module=mycrud&action=create">Create New</a>
</div>

<link href="{$WEB_ROOT}/modules/addons/mycrud/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{$WEB_ROOT}/modules/addons/mycrud/css/styles.css" rel="stylesheet" type="text/css" />

<script src="{$WEB_ROOT}/modules/addons/mycrud/js/jquery-3.7.1.min.js"></script>
<script src="{$WEB_ROOT}/modules/addons/mycrud/js/jquery.dataTables.min.js"></script>

{if $action eq 'index'}
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
                    <a href="?module=mycrud&action=update&id={$item.id}">Edit</a>
                    <a href="?module=mycrud&action=delete&id={$item.id}" onclick="return confirm('Are you sure?')">Delete</a>
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
{elseif $action eq 'create' || $action eq 'update'}
    <h3>{if $action eq 'create'}Create{else}Update{/if} Data</h3>
    <form method="post" action="?module=mycrud&action={if $action eq 'create'}create{else}update{/if}{if $action eq 'update'}&id={$data->id}{/if}">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{if $action eq 'update'}{$data->name}{/if}">
        </div>

        <div class="form-group">
            <label for="value">Value:</label>
            <textarea name="value" id="value">{if $action eq 'update'}{$data->value}{/if}</textarea>
        </div>

        <input type="submit" value="{if $action eq 'create'}Create{else}Update{/if}">
    </form>
{/if}