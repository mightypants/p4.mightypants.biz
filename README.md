p4.mightypants.biz
==================

Project 4 - jDoku

This is a simple sudoku site that includes basic user stats.  Logged in users will have their puzzle-solving times saved and statistics--best time and average time per difficulty level--shown in a dashboard. They can also save and resume their puzzles.  Users who are not logged in can still solve puzzles, but can't save or see any stats.

General actions
- select a difficulty and begin solving (defaults to 'easy' if no selection), or...
- sign up and log in
- view dashboard with user stats and current saved puzzle attempts
- resume saved puzzle or start a new one from the dashboard
- 4 or 5 puzzles for each of the 4 difficulty settings; one is randomly selected on startup

Puzzle-solving features
- puzzle timer
- pause/resume timer; puzzle is hidden while timer is paused
- accepts keyboard input
- clear currently selected cell or all cells
- check answers as you progress, answers auto-checked when the last cell is filled in

Javascript requirement
Most of the puzzle functionality (as described above) relies on javascript--detecting keypress events, DOM manipulation for highlighting errors, etc.  I also used ajax calls for some forms and to check user answers agains puzzle solutions in the database.

Testing notes
- There are two test accounts you can use: 
	- testUser/shhh123 - has completed and saved games so you can check out stats, etc.--the saved "Run away screaming" level puzzle has all but one cell answered so you can test completed puzzle functionality without having to take the time to solve a puzzle from beginning to end
	- testUser2/shhh123 - has no saved data so you can experiment with a clean slate
- check out the 'solution' column in the 'puzzles' table if you want to solve other puzzles quickly

Future additions (if I get around to them)
- undo/redo functionality
- 'pencil' notes/markup: a common sudoku feature that allows users to enter possible candidates in a given cell before the correct answer is determined
- global stats: best, average times for all users per difficulty setting
- integrate a puzzle generator; set it up to run every time a user has played all puzzles of a given difficulty setting