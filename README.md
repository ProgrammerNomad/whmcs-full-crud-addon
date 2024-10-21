# WHMCS My CRUD Addon

This is a simple WHMCS addon that demonstrates how to perform CRUD (Create, Read, Update, Delete) operations on a custom database table. It also includes integration with Bootstrap and DataTables for a better user experience.

## Features

*   Creates a custom database table (`mod_mycrud_data`) upon activation.
*   Provides a basic interface in the WHMCS admin area to manage data in the table.
*   Uses the WHMCS `Capsule` class for database interactions.
*   Integrates Bootstrap for styling.
*   Uses DataTables for enhanced table features (sorting, pagination, searching).
*   Includes a local copy of jQuery.
*   Allows users to choose whether to drop the table during deactivation.

## Installation

1.  Clone or download this repository.
2.  Place the `mycrud` directory into the `modules/addons/` directory of your WHMCS installation.
3.  Go to the "Addons" page in your WHMCS admin area and activate the "My CRUD" addon.

## Usage

Once activated, the addon will be available in your WHMCS admin area. You can access it to view, add, edit, and delete data in the custom table.

## Dependencies

*   WHMCS 6.0 or later
*   Bootstrap (included in the addon)
*   DataTables (included in the addon)
*   jQuery (included in the addon)

## Contributing

Feel free to contribute to this addon by submitting pull requests or reporting issues.

## License

This addon is released under the MIT License.