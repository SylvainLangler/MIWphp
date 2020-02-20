import { Board } from './board';
import { Game } from './game';

let board = new Board();
board.drawBoard();

let game = new Game(board);
game.start();