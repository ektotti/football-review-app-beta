export const players = {
    props: ["number", "name", "className"],
    data: function () {
        return {
            moveStart: false,
            ElementTop: "",
            ElementLeft: "",
            offsetTop: "",
            offsetLeft: "",
        };
    },
    methods: {
        _onMouseDown: function ($e) {
            this.moveStart = true;
            $e.target.classList.add("mouseDowned");
            this.offsetTop =
                $e.offsetY + this.$parent.$el.getBoundingClientRect().top + 10;
            this.offsetLeft =
                $e.offsetX + this.$parent.$el.getBoundingClientRect().left + 10;
        },
        _onMouseMove: function ($e) {
            if (this.moveStart) {
                this.ElementTop = $e.clientY - this.offsetTop;
                this.ElementLeft = $e.clientX - this.offsetLeft;
            }
        },
        _onMouseUp: function ($e) {
            this.moveStart = false;
            $e.target.classList.remove("mouseDowned");
            this.ElementTop += 10
            this.ElementLeft += 10;

        },
        _onMouseLeave: function () {
            if (this.moveStart) {
                this.moveStart = false;
            }
        },
    },
}