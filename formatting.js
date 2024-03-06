function formatText() {
    const selection = window.getSelection();
    if (selection.toString().length === 0) return; // Handle no selection

    const selectedText = selection.toString();
    let formattedText = "";

    switch (action) {
        case "bold":
            formattedText = `<b>${selectedText}</b>`;
            break;
        case "italic":
            formattedText = `<i>${selectedText}</i>`;
            break;
        case "uppercase":
            formattedText = selectedText.toUpperCase();
            break;
        case "increaseFontSize":
            const fontSize = parseInt(getComputedStyle(selection.anchorNode).fontSize) || 16; // Default to 16px
            formattedText = `<span style="font-size: ${fontSize + 2}px;">${selectedText}</span>`;
            break;
        case "decreaseFontSize":
            const decFontSize = parseInt(getComputedStyle(selection.anchorNode).fontSize) || 16; // Default to 16px
            // Ensure the font size doesn't become too small
            const newFontSize = Math.max(decFontSize - 2, 12); // Minimum font size of 12px
            formattedText = `<span style="font-size: ${newFontSize}px;">${selectedText}</span>`;
            break;
    }

    // Replace the selected text with the formatted text
    selection.deleteFromDocument();
    const range = selection.getRangeAt(0);
    range.insertNode(document.createTextNode(formattedText));
}