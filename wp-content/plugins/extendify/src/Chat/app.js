import { render, createRoot } from '@wordpress/element';
import { Chat } from '@chat/Chat';
import './app.css';

requestAnimationFrame(() => {
	if (window.parent !== window) return;
	const chat = Object.assign(document.createElement('div'), {
		className: 'extendify-chat',
	});
	document.body.append(chat);
	if (typeof createRoot !== 'function') {
		render(<Chat />, chat);
		return;
	}
	createRoot(chat).render(<Chat />);
});
