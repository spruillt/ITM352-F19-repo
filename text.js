<!DOCTYPE html>
<html>

<body>

    <script>
        var item1 = 'Gillette Sensor 3 Razors';
        var quantity1 = 2;
        var price1 = 1.23;
        var extended_price1 = quantity1 * price1;
        var item2 = 'Barbasol Shaving Cream';
        var quantity2 = 3;
        var price2 = 2.00;
        var extended_price2 = price2 * quantity2;
        var item3 = 'Nautica Cologne';
        var quantity3 = 4;
        var price3 = 2.50;
        var extended_price3 = price3 * quantity3
        var item4 = 'Rubbing Alcohol';
        var quantity4 = 1;
        var price4 = 0.50;
        var extended_price4 = price4 * quantity4;
        var item5 = 'Colgate Classic Toothbrush';
        var quantity5 = 2;
        var price5 = 1.00;
        var extended_price5 = price5 * quantity5;
        var subtotal = extended_price1 + extended_price2 + extended_price3 + extended_price4 + extended_price5;
        document.write(`
        <table border="2">
            <tbody>
                <tr>
                <th style="text-align: center;" width="43%">Item</th>
                <th style="text-align: center;" width="11%">Quantity</th>
                <th style="text-align: center;" width="13%">Price</th>
                <th style="text-align: center;" width="54%">Extended price</th>
                </tr>
                <tr>
                <td width="43%">${item1}</td>
                <td align="center" width=${quantity1}>2</td>
                <td width="13%">$${price1}</td>
                <td width="54%">$${extended_price1}</td>
                </tr>
                <tr>
                <td width="43%">${item2}</td>
                <td align="center" width=${quantity2}>1</td>
                <td width="13%">$${price2}</td>
                <td width="54%">$${extended_price2}</td>
                </tr>
                <tr>
                <td width="43%">${item3}</td>
                <td align="center" width=${quantity3}>1</td>
                <td width="13%">$${price3}</td>
                <td width="54%">$${extended_price3}</td>
                </tr>
                <tr>
                <td width="43%">${item4}</td>
                <td align="center" width=${quantity4}>1</td>
                <td width="13%">$${price4}</td>
                <td width="54%">$${extended_price4}</td>
                </tr>
                <tr>
                <td width="43%">${item5}</td>
                <td align="center" width=${quantity5}>1</td>
                <td width="13%">$${price5}</td>
                <td width="54%">$${extended_price5}</td>
                </tr>
                <tr>
                <td colspan="4" width="100%">&nbsp;</td>
                </tr>
                <tr>
                <td style="text-align: center;" colspan="3" width="67%">Sub-total</td>
                <td width="54%">$36.89</td>
                </tr>
                <tr>
                <td style="text-align: center;" colspan="3" width="67%"><span style="font-family: arial;">Tax @ 5.75%</span></td>
                <td width="54%">$2.12</td>
                </tr>
                <tr>
                <td style="text-align: center;" colspan="3" width="67%"><strong>Total</strong></td>
                <td width="54%"><strong>$39.01</strong></td>
                </tr>
            </tbody>
        </table>`)

    </script>

</body>

</html>