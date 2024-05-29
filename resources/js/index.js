import {GridStack} from 'gridstack';

export default function gridStackDashboard({
                                               columns = 12,
                                               rows = 0,
                                               float = true,
                                               disableResize = false,
                                               disableDrag = false,
                                               resizable = 'se'
                                           }) {
    return {
        grid: null,
        gridItems: this.$wire.entangle('gridItems'),
        addItem: function (id, name) {
            this.grid.addWidget({w: 12, id: id, content: name})
        },
        removeAll: function () {
            this.grid.removeAll()
            this.gridItems = []
        },

        init: function () {
            this.grid = GridStack.init({
                cellHeight: 80,
                column: columns,
                row: rows,
                float: float,
                disableDrag: disableDrag,
                disableResize: disableResize,
                acceptWidgets: true,
                resizable: {
                    handles: resizable
                },
                removable: '#trash',
                alwaysShowResizeHandle: true,
                disableOneColumnMode: true,
            })
            this.grid.load(this.gridItems)
            let rootThis = this;
            this.grid.on('removed', function (event, items) {
                let newItems = []
                items.forEach(function (item) {
                    newItems = rootThis.gridItems.filter(function (obj) {
                        return obj.id !== item.id
                    })
                })
                rootThis.gridItems = newItems
            })
            this.grid.on('added', function (event, items) {
                let newItems = []
                items.forEach(function (item) {
                    let newItem = {
                        id: item.id,
                        content: item.content,
                        w: item.w,
                        x: item.x,
                        y: item.y,
                    }
                    newItems.push(newItem)
                })
                rootThis.gridItems = rootThis.gridItems.concat(newItems)
            })
            this.grid.on('change', function (event, items) {
                rootThis.gridItems.forEach(function (gridItem, i) {
                    items.forEach(function (item) {
                        if (item.id === gridItem.id) {
                            rootThis.gridItems[i].x = item.x
                            rootThis.gridItems[i].w = item.w
                            rootThis.gridItems[i].y = item.y
                        }
                    })
                })
            })
        },
    }
}