<?php
namespace GaBlog\Int;

/**
 * Interface for Backend Area
 * @author Gianluca Arbezzano<gianarb92@gmail.com>
 */
interface Backend
{
    /**
     * list of values
     */
    public function gridAction();

    /**
     * view of form from edit
     */
    public function viewAction();

    /**
     * insert or edit record into database
     */
    public function editAction();

    /**
     * insert or edit record into database
     */
    public function deleteAction();

}
