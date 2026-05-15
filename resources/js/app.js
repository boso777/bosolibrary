import "tailwindcss";

//tom select for categories settings


//event listener su funzione specifica che da true solo quando livewire ha finito di scansionare tutto il dom
document.addEventListener('livewire:initialized', () => {
    const el = document.getElementById('select-categories');
    if (el) {
        const ts = new TomSelect(el, {
            plugins: ['remove_button'],
            onChange: (values) => {
                // Recupera l'istanza Livewire del componente e setta il valore
                let component = Livewire.find(el.closest('[wire\\:id]').getAttribute('wire:id'));
                component.set('selected_categories', values);
            }
        });
    }
});
