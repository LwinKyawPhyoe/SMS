export const Util = {
    //Validate Field
    onValidate(value, inputId, megId)
    {
        if(value == "" || value == undefined) document.getElementById(inputId).style.border = 'solid 1px red';
        else 
        {
            document.getElementById(inputId).style.border = 'solid 1px #d2d6de';
            document.getElementById(megId).style.display = 'none';
        }
    },

    //Validate Message
    onValidateMessage(inputId, megId)
    {
        document.getElementById(inputId).style.border = 'solid 1px red';
        document.getElementById(megId).style.display = 'block';
    },
    
    //Type Only Number
    restrictSpecialCharacter(event, fid, value)
    {
        if (event.which != 9)
        {
            if (fid == 101)
            {
                if (/^[\\\"\'\;\:\>\|~`!@#\$%^&*\(\)]$/i.test(event.key))
                {
                    event.preventDefault();
                }
            }
        
            if (!((event.which > 47 && event.which < 58) || event.which == 8 || event.which == 46 || event.which == 37 || event.which == 39 || event.which == 190 || (event.keyCode >= 96 && event.keyCode <= 105))) 
            {
                event.preventDefault();
            }

            if(value != undefined)
            {
                if (value.includes("."))
                {
                    if (/^[\\\"\'\;\:\>\|~`!@#\$%^&*.\(\)]$/i.test(event.key))
                    {
                        event.preventDefault();
                    }
                }
            }
        }
    },

    //Type Phone Number
    restrictPhoneNo(event, value)
    {
        if(event.keyCode != 8 && !(/[0-9\+\-\ ]/i.test(event.key)))
        {
            event.preventDefault();
        }

        if(value != undefined && value !="")
        {
            if (/^[\\\"\'\;\:\>\|~`!@#\$%^&*+\(\)]$/i.test(event.key))
            {
                event.preventDefault();
            }
        }
    },

    //Create Thousand Sperator
    thousand_sperator(num) 
    {
        if (num != "" && num != undefined && num != null) 
        {
            num = num.replace(/,/g, "");
        }   
        var parts = num.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return parts;
    },

    //Print
    printme(table)
    {
        let printContents, popupWin;
        printContents = document.getElementById(table).innerHTML;
        popupWin = window.open('', '_blank', 'top=0,left=0,height=100%,width=auto');
        popupWin.document.open();
        popupWin.document.write(`
            <html>
                <head>
                    <title>Print tab</title>
                    <style>
                    //........Customized style.......
                    </style>
                </head>
            <body onload="window.print();window.close()">${printContents}</body>
            </html>`
        );
        popupWin.document.close();
    },

    //Download Excel
    downloadExcel:function(table, name, filename) 
    {
        let uri = 'data:application/vnd.ms-excel;base64,', 
        template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><title></title><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>', 
        base64 = function(s) { return window.btoa(decodeURIComponent(encodeURIComponent(s))) },
        format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; })}
        
        if (!table.nodeType) table = document.getElementById(table)
        var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}

        var link = document.createElement('a');
        link.download = filename;
        link.href = uri + base64(format(template, ctx));
        link.click();
    },
};