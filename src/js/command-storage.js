class CommandStorage {
    /**
     * Navigation in history
     * @param direction
     * @returns {boolean}
     */
    commandHistoryNavigation (direction) {
        if (this.archive.length === 0) return false; // history empty
        if (this.pointer === 0 && direction === "up") return false; // already on first command
        if (this.pointer === this.archive.length - 1 && direction === "down") return false; // already on last command

        /* moving pointer */
        if (direction === "up")   this.pointer--;
        if (direction === "down") this.pointer++;
        /**/

        const preCommandPosition = window.TerminalTextarea.target.value.lastIndexOf("$");

        if (preCommandPosition === -1) {
            window.TerminalTextarea.target.value = window.TerminalTextarea.preCommand + this.archive[this.pointer];
        } else {
            window.TerminalTextarea.target.value = window.TerminalTextarea.target.value.substr(0, preCommandPosition)
                                                 + "$ "
                                                 + this.archive[this.pointer];
        }
    }

    constructor() {
        this.archive = []; //Here we will store history of commands that was put by user
        this.pointer = 0; //user can navigate in history with arrows so we need store pointer that looking at current position
    }
}
