function addEventRow() {
    // Create a new row element
    const newRow = document.createElement('tr');
    newRow.classList.add('text-center');

    // Add cells with placeholders for new event details
    newRow.innerHTML = `
        <td class="py-3 px-4 border-b border-gray-300"><input type="text" class="border rounded px-2 py-1" placeholder="Enter event type"></td>
        <td class="py-3 px-4 border-b border-gray-300"><input type="text" class="border rounded px-2 py-1" placeholder="Enter date and venue"></td>
        <td class="py-3 px-4 border-b border-gray-300"><input type="text" class="border rounded px-2 py-1" placeholder="Enter tasks assigned"></td>
    `;

    // Append the new row to the table body
    document.querySelector('#eventTable tbody').appendChild(newRow);
}
