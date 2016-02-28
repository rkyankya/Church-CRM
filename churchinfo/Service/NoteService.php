<?php

class NoteService
{

    function addNote($personID, $familyID, $private, $text) {
            $sSQL = "INSERT INTO note_nte (nte_per_ID, nte_fam_ID, nte_Private, nte_Text, nte_EnteredBy, nte_DateEntered)
                VALUES (" . $personID . "," . $familyID . "," . $private . ",'" . $text . "'," .
                $_SESSION['iUserID'] . ",'" . date("YmdHis") . "')";

        //Execute the SQL
        RunQuery($sSQL);

    }

    function updateNote($noteId, $private, $text) {
        $sSQL = "UPDATE note_nte SET
                nte_Private = " . $private .  ",
                nte_Text = '" . $text . "' ,
                nte_DateLastEdited = '" . date("YmdHis") . "',
                nte_EditedBy = " . $_SESSION['iUserID'] . "
            WHERE nte_ID = " . $noteId;

        //Execute the SQL
        RunQuery($sSQL);

    } 

    function getNoteById($noteId) {
        $sSQL = "SELECT * FROM note_nte WHERE nte_ID = " . $noteId;
        $rsNote = RunQuery($sSQL);
        $note['id'] = $rsNote['nte_ID'];
        $note['familyId'] = $rsNote['nte_fam_ID'];
        $note['personId'] = $rsNote['nte_per_ID'];
        $note['private'] = $rsNote['nte_Private'];
        $note['text'] = $rsNote['nte_Text'];
        $note['entered'] = $rsNote['nte_DateEntered'];
        $note['enteredById'] = $rsNote['nte_EnteredBy'];
        $note['edited'] = $rsNote['nte_DateLastEdited'];
        $note['editedById'] = $rsNote['nte_EditedBy'];
        return $note;
    }

    function deleteNoteById($noteId) {
        $sSQL = "DELETE FROM note_nte WHERE nte_ID = " . $noteId;
        return RunQuery($sSQL);
    }

}
