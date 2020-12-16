var Select2Cascade = ( function(window, $) {
    function Select2Cascade(parent, child, url, select2Options, parentOptions) {
        var afterActions = [];
        var options = select2Options || {};

        // Register functions to be called after cascading data loading done
        this.then = function(callback) {
            afterActions.push(callback);
            return this;
        };
        var parentId = parent.attr('id');
        var currentParentElement =  $('#' + camelize('current ' + parentId));
        parent.select2(
          parentOptions
        ).on("change", function (e) {
            var childId = child.attr('id');
            var currentChildElement =  $('#' + camelize('current ' + childId));
            child.prop("disabled", true);
            var _this = this;
            var sufixUrl = child.prop('name');
            var value = $(this).val();
            switch (sufixUrl) {
                case 'colonia':
                    var sufix = !isOffline ? '/localidades/07/' : '?wscatgeo=localidad&mgem=07&agem=';
                    sufix = sufix + value;
                break;
            }

            $.getJSON(url + sufix, function(items) {
                var newOptions = '<option value="">-- Seleccionar un elemento --</option>';
                var datas = items.datos;
                datas.sort(function (a, b) {
                    if (a.nom_loc > b.nom_loc) {
                        return 1;
                    }
                    if (a.nom_loc < b.nom_loc) {
                        return -1;
                    }
                    // a must be equal to b
                    return 0;
                })
                for(var id in datas) {
                    newOptions += '<option value="'+ datas[id].cve_loc +'">'+ datas[id].nom_loc +'</option>';
                }
                child.select2('destroy').html(newOptions).prop("disabled", false)
                    .select2(options);

                if (currentChildElement.length && currentChildElement.val()) {
                    var url_loc = !isOffline ?  url + '/localidades/07' + currentParentElement.val() + '' + currentChildElement.val(): url + '?wscatgeo=info_loc&agem='+ currentParentElement.val() +'&loc=' + currentChildElement.val()
                    $.ajax({
                        type: 'GET',
                        url: url_loc,
                        dataType: 'json',
                    }).then(function (data) {
                        var datos = data.datos;
                        var option = new Option(datos[0].nom_loc, datos[0].cve_loc, true, true);
                        child.append(option).trigger('change');
                        child.trigger({
                            type: 'select2:select',
                            params: {
                                data: data.datos
                            }
                        });
                    })
                }
                afterActions.forEach(function (callback) {
                    callback(parent, child, items);
                });
            });
        });
        if (currentParentElement.length && currentParentElement.val()) {
            var url_agem = !isOffline ?  url + '/mgem/07/' : url + '?wscatgeo=info_agem&agem='
            $.ajax({
                type: 'GET',
                url: url_agem + currentParentElement.val(), // 'https://gaia.inegi.org.mx/wscatgeo/mgem/07/' + currentParentElement.val()
                dataType: 'json',
            }).then(function (data) {
                var datos = data.datos;
                var option = new Option(datos[0].nom_agem, datos[0].cve_agem, true, true);
                parent.append(option).trigger('change');
                parent.trigger({
                    type: 'select2:select',
                    params: {
                        data: data.datos
                    }
                });
            })
        }
    }

    return Select2Cascade;

})( window, $);
