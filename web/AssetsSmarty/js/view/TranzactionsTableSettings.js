function initTable3() {
    var table = jQuery('#sample_3');


    /* Formatting function for row expanded details */
    function fnFormatDetails(oTable, nTr) {
        var aData = oTable.fnGetData(nTr);
        var sOut = '<table>';
        sOut += '<tr><td>ID пользователя: </td><td>' + aData[9] + '</td></tr>';
        sOut += '<tr><td width="130px"><span style="white-space: nowrap;">Время запроса:</span></td><td>' + aData[2] + '</td></tr>';
        sOut += '<tr><td><span style="white-space: nowrap; ">Источник запроса:</span></td><td>' + aData[3] + '</td></tr>';
        sOut += '<tr><td>Ключ в запросе:</td><td>' + aData[7] + '</td></tr>';
        sOut += '<tr><td valign="top"><span style="white-space: nowrap;">Статус запроса:</span></td><td><span>' + aData[4] + '</span></td></tr>';
        sOut += '<tr><td><span style="white-space: nowrap; ">ID номер запроса: </span></td><td>' + aData[1] + '</td></tr>';
        sOut += '<tr><td valign="top">Вид доставки: </td><td>' + aData[5] + '</td></tr>';
        sOut += '<tr><td>Статус ответа:</td><td>' + aData[6] + '</td></tr>';
        sOut += '<tr><td>Новый баланс: </td><td>' + aData[8] + ' руб.' +'</td></tr>';
        sOut += '<tr><td>'+'<br>'+'</td><td>'+'<br> '+'</td></tr>';
        sOut += '<tr><td></td><td>' + aData[10] + '</td></tr>';
        sOut += '</table>';


        return sOut;
    }

    /*
     * Insert a 'details' column to the table
     */
    var nCloneTh = document.createElement('th');
    nCloneTh.className = "table-checkbox";

    var nCloneTd = document.createElement('td');
    nCloneTd.innerHTML = '<span class = "row-details row-details-close"></span>';

    table.find('thead tr').each(function () {
        this.insertBefore(nCloneTh, this.childNodes[0]);
    });

    table.find('tbody tr').each(function () {
        this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
    });

    var oTable = table.dataTable({
            "columnDefs": [{
                "targets": [10],
                "visible": false,
                "searchable": false
            },{
                "targets": [5],
                "visible": false,
                "searchable": false
            },{
                "targets": [7],
                "visible": false,
                "searchable": false
            },{
                "targets": [9],
                "visible": false,
                "searchable": false
            },{
                "targets": [1],
                "visible": false,
                "searchable": false
            },{
                "orderable": false,
                "targets": [0]
            }],
            "lengthMenu": [
                [5,10,13],
                [5,10,13] // change per page values here
            ],
            // set the initial value
            "pageLength": 13,
            "dom": '<"top">rt<"bottom"p><"clear">',
            "scrollX": true,
            "stateSave": false,


        }

    );

    var tableWrapper = jQuery('#sample_4_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper
    var tableColumnToggler = jQuery('#sample_4_column_toggler');

    /* modify datatable control inputs */
    tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown

    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
    table.on('click', ' tbody td .row-details', function () {
        var nTr = jQuery(this).parents('tr')[0];
        if (oTable.fnIsOpen(nTr)) {
            /* This row is already open - close it */
            jQuery(this).addClass("row-details-close").removeClass("row-details-open");
            oTable.fnClose(nTr);
        } else {
            /* Open this row */
            jQuery(this).addClass("row-details-open").removeClass("row-details-close");
            oTable.fnOpen(nTr, fnFormatDetails(oTable, nTr), 'details');
        }
    });

    /* handle show/hide columns*/
    jQuery('input[type="checkbox"]', tableColumnToggler).change(function () {
        /* Get the DataTables object again - this is not a recreation, just a get of the object */
        var iCol = parseInt(jQuery(this).attr("data-column"));
        var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
        oTable.fnSetColumnVis(iCol, (bVis ? false : true));
    });
}



// Table Init
initTable3();