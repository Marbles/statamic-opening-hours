/** global: Vue */
Vue.component('opening_hours-fieldtype', {

    template: '' +
    '<hr>' +
    '<div v-for="(day, hours) in data">' +
        '<h2 v-text="translate(\'addons.OpeningHours::settings.\' + day)"></h2>' +
        '<div class="row" v-for="(index, hour) in data[day]">' +
            '<div class="form-group col-xs-5" style="padding-bottom: 0; padding-top: 0;">' +
                '<label>{{ translate("addons.OpeningHours::settings.from") }}</label>' +
                '<input type="time" name="{{ day }}_from[]" class="form-control" v-model="hour.from">' +
            '</div>' +
            '<div class="form-group col-xs-5" style="padding-bottom: 0; padding-top: 0;">' +
                '<label>{{ translate("addons.OpeningHours::settings.to") }}</label>' +
                '<input type="time" name="{{ day }}_to[]" class="form-control" v-model="hour.to">' +
            '</div>' +
            '<div class="form-group col-xs-2" style="padding-bottom: 0; padding-top: 0;">' +
                '<label>{{ translate("addons.OpeningHours::settings.delete") }}</label>' +
                '<button :disabled="index == 0" class="btn btn-delete btn-block" @click="removeHours(day, index)"><i class="icon icon-circle-with-cross" style="color: #fff;"></i></button>' +
            '</div>' +
        '</div>' +
        '<button class="btn btn-success btn-xs" @click="addHours(day)">{{ translate("addons.OpeningHours::settings.add_hours") }}</button>' +
        '<hr>' +
    '</div>' +
    '',

    props: ['data', 'config', 'name'],

    data: function() {
        return {
            opening_hours: {}
        };
    },

    computed: {

    },

    methods: {
        addHours: function (day) {
            this.data[day].push({ from: '', to: ''});
        },
        removeHours: function (day, index) {
            this.data[day].splice(index, 1);
        }
    },

    ready: function() {
        var title = this.translate('addons.OpeningHours::settings.title');
        jQuery('#publish-title').html(title);
    }

});