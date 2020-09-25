<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
        integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
        crossorigin="" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
        integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
        crossorigin=""></script>

    <style>
    #koperasi-map {
        height: 100vh;
    }

    .z-99 {
        z-index: 999;
    }

    .sidetop-utitliy {
        min-width: 25vw;
    }
    </style>
</head>

<body>
    <div class="sidetop-utitliy ml-2 mt-2 absolute top-0 left-0 z-99 p-4">
        <div class="bg-white rounded-lg px-2 py-4 text-gray-700 flex items-center">
            <button title="menu">
                <svg class="w-6 h-6 mr-2" fill="currentColor" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7">
                    </path>
                </svg>
            </button>
            <!-- <input type="text" class="px-2 focus:outline-none" placeholder="cari koperasi"> -->
            <select class="koperasi-select">
                <option value="">semua</option>
                <option value="1">koperasi al mahirah</option>
                <option value="2">koperasi adek abang</option>
            </select>

        </div>
    </div>
    <div id="koperasi-map"></div>

    <script>
    class KoperasiMap {
        constructor(id, view, zoomLevel) {
            this.id = id
            this.view = view;
            this.zoomLevel = zoomLevel
            this.tokenMap =
                'pk.eyJ1IjoieW9nYWFsdGFyaXoiLCJhIjoiY2tjdzI3M3k0MDl1ejJ2bGE0Y3l0M3FoeCJ9.4t6IoUSf2tqc1hjdRC7KhQ'
            this.L = L
            this.map = this.L.map(this.id).setView(this.view, this.zoomLevel)
        }

        init() {
            this.L.tileLayer(
                'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                    maxZoom: 18,
                    id: 'mapbox/streets-v11',
                    tileSize: 512,
                    zoomOffset: -1,
                    zoomControl: false,
                    accessToken: this.tokenMap
                }).addTo(this.map);

            this.map.zoomControl.remove();

            this.L.control.zoom({
                position: 'bottomright'
            }).addTo(this.map);

            // this.fetchData().then(() => {
            //     this.renderPlaceToMap()

            // })

        }

        // fetchData() {
        //     return new Promise(async (resolve, reject) => {
        //         try {
        //             const response = await fetch("data.json")
        //             this.data = await response.json()
        //             resolve()
        //         } catch (error) {
        //             reject(error)
        //         }
        //     })
        // }

        renderPlaceToMap() {
            this.data.features.forEach(feature => {
                this.L.marker(feature.geometry.coordinates).bindPopup(
                    `<strong>${feature.properties.name}</strong>`).addTo(this.map)
            })
        }
    }

    const koperasiMap = new KoperasiMap('koperasi-map', [5.548290, 95.323753], 13).init()


    const element = document.querySelector('.koperasi-select')
    const choices = new Choices(element, {
        classNames: {
            containerOuter: 'choices w-full ml-2',
            containerInner: 'border-0 bg-white',
            input: 'choices__input',
            inputCloned: 'choices__input--cloned',
            list: 'choices__list',
            listItems: 'choices__list--multiple',
            listSingle: 'choices__list--single',
            listDropdown: 'choices__list--dropdown',
            item: 'choices__item',
            itemSelectable: 'choices__item--selectable',
            itemDisabled: 'choices__item--disabled',
            itemChoice: 'choices__item--choice',
            placeholder: 'choices__placeholder',
            group: 'choices__group',
            groupHeading: 'choices__heading',
            button: 'choices__button',
            activeState: 'is-active',
            focusState: 'is-focused',
            openState: 'is-open',
            disabledState: 'is-disabled',
            highlightedState: 'is-highlighted',
            selectedState: 'is-selected',
            flippedState: 'is-flipped',
            loadingState: 'is-loading',
            noResults: 'has-no-results',
            noChoices: 'has-no-choices'
        },
    })
    </script>
</body>

</html>